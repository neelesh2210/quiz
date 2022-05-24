<style>
    .error{color:#bc0808; font-size:16px;}
    hr {
    margin-top: 0px;
    margin-bottom: 10px;
    border: 0;
    border-top: 1px solid #bc0808;
}
.sub {
        font-weight: 600;font-size: 14px;padding: 6px;background-color: #bc0808;color: white;border-radius: 8px;
    }
</style>
@foreach ($questions as $key => $question)
    <div class="quest_img">
      
        <span>Q. {{ $question['id'] }}</span>  <span class="sub" style="float: right;">{{ $question['subject'] }}</span><br>
        <hr>
            <img src="../../../images/questions/{{$question['question_img']}}" class="w-100"
            alt=""><br><br>
    </div>
        <input type="hidden" id="question_awn" name="question_id" value="{{$question['id']}}">
        <input type="hidden" id="topic_awn" name="topic_id" value="{{$topic->id}}">
        <input type="hidden" id="answer_awn" name="answer" value="{{$question['answer']}}">
      
        <label class="options">A
            <input type="radio" name="user_answer" value="A">
            <span class="checkmark"></span>
        </label>
        <label class="options">B
            <input type="radio" name="user_answer" value="B">
            <span class="checkmark"></span>
        </label>
        <label class="options">C
            <input type="radio" name="user_answer" value="C">
            <span class="checkmark"></span>
        </label>
        <label class="options">D
            <input type="radio" name="user_answer" value="D">
            <span class="checkmark"></span>
        </label>
        <span id="spnError" class="error" style="display: none"> Please select answer </span>
        <br>
        <div id="verifiBtn">
            @if ($questions->currentPage() == $questions->lastPage())
                <a class="btn col-auto btn-wave" href="#" onclick="final_submit()">Submit <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
            @else
                <a onclick="next_question()" id ="btnSubmit" href="#" class="btn col-auto btn-wave">Next</a>
            @endif
        </div>
@endforeach

{{-- href="{{asset('start-quiz-index/'.$topic->id.$questions->url($questions->currentPage()+1))}}" --}}

<script>
    function next_question() 
    {
        var question_awn=$('#question_awn').val();
        var topic_awn=$('#topic_awn').val();
        var chcekk=$("input[name='user_answer']:checked").val();
        $.ajax({
            url: "{{ asset('start-quiz-index/' . $topic->id . $questions->url($questions->currentPage() + 1)) }}"+"&question_id="+question_awn+"&topic_id="+topic_awn+"&user_answer="+chcekk,
            success: function(data) 
            {
                $('#question_div').html(data)
            },
        });
    }
</script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
