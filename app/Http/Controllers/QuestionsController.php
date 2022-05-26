<?php

namespace App\Http\Controllers;

use App\Topic;
use App\Answer;
use App\Question;
use Illuminate\Http\Request;
use App\Imports\QuestionsImport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $topics = Topic::all();
        $questions = Question::all();
        return view('admin.questions.index', compact('questions', 'topics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,$id)
    { 
        //return $request->all();
        $answer=Answer::where('topic_id',$id)->where('user_id',Auth::user()->id)->where('question_id',$request->question_id)->first();
        if(empty($answer))
        {
          if($request->ajax())
          {
              Answer::create([
                'topic_id'=>$request->topic_id,
                'user_id'=>Auth::user()->id,
                'question_id'=>$request->question_id,
                'user_answer'=>$request->user_answer,
                'answer'=>Question::where('id',$request->question_id)->first()->answer
              ]);
              
          $topic=Topic::where('id',$id)->first();          
           $check_questions=Answer::where('topic_id',$id)->where('user_id',Auth::user()->id)->pluck('question_id');

           $phy_que=[];

               foreach($check_questions as $check_question) 
               {
                  $physics_questions=Question::where('topic_id',$id)->where('subject','physics')->where('id','!=',$check_question)->get()->shuffle();
                  foreach($physics_questions as $physics_question)
                  {
                    array_push($phy_que,$physics_question);
                  }
               }

               $physics_questions= array_slice($phy_que, 0, 5, true);

               $che_que=[];

               foreach($check_questions as $check_question) 
               {
                $chemistry_questions=Question::where('topic_id',$id)->where('subject','chemistry')->get()->shuffle();
                  foreach($chemistry_questions as $chemistry_question)
                  {
                    array_push($che_que,$chemistry_question);
                  }
               }

               $chemistry_questions= array_slice($che_que, 0, 5, true);

               $bio_que=[];

               foreach($check_questions as $check_question) 
               {
                $biology_questions=Question::where('topic_id',$id)->where('subject','biology')->get()->shuffle();
                  foreach($biology_questions as $biology_question)
                  {
                    array_push($bio_que,$biology_question);
                  }
               }

               $biology_questions= array_slice($bio_que, 0, 5, true);         

          $array1=array_merge($physics_questions,$chemistry_questions);
          $final_array=array_merge($array1,$biology_questions);
          $questions = $this->paginate($final_array);

              return view('quiz.question.question',compact('questions','topic'));
          }
          else
          {
          $topic=Topic::where('id',$id)->first();          
          $physics_questions=Question::where('topic_id',$id)->where('subject','physics')->get()->shuffle()->take(5);
          $chemistry_questions=Question::where('topic_id',$id)->where('subject','chemistry')->get()->shuffle()->take(5);
          $biology_questions=Question::where('topic_id',$id)->where('subject','biology')->get()->shuffle()->take(5);

          $array1=array_merge($physics_questions->toArray(),$chemistry_questions->toArray());
          $final_array=array_merge($array1,$biology_questions->toArray());
          $questions = $this->paginate($final_array);
              return view('quiz.question.index',compact('questions','topic'));
          }
        }
        else
        {
          return back()->with('error','You Have Already Participated In This Quiz!');
        }
    }

    public function paginate($items, $perPage = 1, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    /**
     * Import a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function importExcelToDB(Request $request)
    {
       $validator = Validator::make(
        [
            'question_file' => $request->question_file,
            'extension' => strtolower($request->question_file->getClientOriginalExtension()),
        ],
        [
            'question_file' => 'required',
            'extension' => 'required|in:xlsx,xls,csv',
        ]
      );

      if ($validator->fails()) 
      {
        return back()->withErrors('deleted','Invalid file format Please use xlsx and csv file format !');
      }

      if($request->hasFile('question_file'))
      {
        // return $request->file('question_file');
        Excel::import(new QuestionsImport, $request->file('question_file'));
        return back()->with('added', 'Question Imported Successfully');
      }
        return back()->with('deleted', 'Request data does not have any files to import');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
          'topic_id' => 'required',
          'subject' => 'required',
          'a' => 'required',
          'b' => 'required',
          'c' => 'required',
          'd' => 'required',
          'answer' => 'required',
          'question_img' => 'sometimes|image|mimes:jpg,jpeg,png'
        ]);

         // return $request;

        $input = $request->all();

        if ($file = $request->file('question_img')) {

            $name = 'question_'.time().$file->getClientOriginalName();
            
            $file->move('images/questions/', $name);
            $input['question_img'] = $name;

        }
        

        try{
          Question::create($input);
          return back()->with('added', 'Question has been added');
        }catch(\Exception $e){
           return back()->with('deleted',$e->getMessage());
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(request $request,$id)
    {
        $topic = Topic::findOrFail($id);
        
        $questions = \DB::table('questions')->where('topic_id', $topic->id)->select('id','question','subject','a','b','c','d','e','f','answer');

        if($request->ajax())
        {
          return DataTables::of($questions)
          ->addIndexColumn()
          ->addColumn('question',function($row){
              return $row->question;
          })
          ->addColumn('a',function($row){
              return $row->a;
          })
          ->addColumn('b',function($row){
              return $row->b;
          })
          ->addColumn('c',function($row){
              return $row->c;
          })
          ->addColumn('d',function($row){
              return $row->d;
          })
          ->addColumn('e',function($row){
              return $row->e;
          })
          ->addColumn('f',function($row){
              return $row->f;
          })
          ->addColumn('answer',function($row){
              return $row->answer;
          })

          ->addColumn('action', function($row){

              $btn = '<div class="admin-table-action-block">

                  <a href="' . route('questions.edit', $row->id) . '" data-toggle="tooltip" data-original-title="Edit" class="btn btn-primary btn-floating"><i class="fa fa-pencil"></i></a>
                
                  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal' . $row->id . '"><i class="fa fa-trash"></i> </button></div>';

                    $btn .= '<div id="deleteModal' . $row->id . '" class="delete-modal modal fade" role="dialog">
                <div class="modal-dialog modal-sm">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <div class="delete-icon"></div>
                    </div>
                    <div class="modal-body text-center">
                      <h4 class="modal-heading">Are You Sure ?</h4>
                      <p>Do you really want to delete these records? This process cannot be undone.</p>
                    </div>
                    <div class="modal-footer">
                      <form method="POST" action="' . route("questions.destroy", $row->id) . '">
                        ' . method_field("DELETE") . '
                        ' . csrf_field() . '
                          <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">No</button>
                          <button type="submit" class="btn btn-danger">Yes</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>';

              return $btn;
          })
          ->rawColumns(['question','a','b','c','d','e','f','answer','action'])
          ->make(true);
        }
        return view('admin.questions.show', compact('topic', 'questions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::find($id);
        $topic = Topic::where('id',$question->topic_id)->first();
       return view('admin.questions.edit',compact('question','topic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $question = Question::find($id);
        $request->validate([
          'topic_id' => 'required',
          'subject' => 'required',
          'a' => 'required',
          'b' => 'required',
          'c' => 'required',
          'd' => 'required',
          'answer' => 'required',
          'question_img' => 'sometimes|image|mimes:jpg,jpeg,png'
        ]);

        $input = $request->all();

        if ($file = $request->file('question_img')) {

            $name = 'question_'.time().$file->getClientOriginalName();

            if($question->question_img != null) {
                unlink(public_path().'/images/questions/'.$question->question_img);
            }

            $file->move('images/questions/', $name);
            $input['question_img'] = $name;

        }

        try
        {
          $question->update($input);
          return back()->with('updated', 'Question has been updated');
        }
        catch(\Exception $e)
        {
          return back()->with('deleted',$e->getMessage());
        }

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::find($id);

        if ($question->question_img != null) {
            unlink(public_path().'/images/questions/'.$question->question_img);
        }
        try{
          $question->delete();
          return back()->with('deleted', 'Question has been deleted');
        }
        catch(\Exception $e)
        {
          return back()->with('deleted',$e->getMessage());
        }
        
    }
    public function submitAnswer(Request $request)
    {
      $answer = new Answer();
      $answer->topic_id = $request->topic_id;
      $answer->user_id = auth()->user()->id;
      $answer->question_id = $request->question_id;
      $answer->user_answer = $request->user_answer;
      $answer->answer = $request->answer;
      $answer->save();
    }
    
}
