<template>
  <div class="main-questions">
    <div class="myQuestion" v-for="(question, index) in questions">
      <div class="row">

    
        
        <div class="col-md-12">
          <blockquote>
            Total Questions &nbsp;&nbsp;{{ index+1 }} / {{questions.length}}
          </blockquote>
         

              <div class="col-lg-6 col-md-6 col-sm-12" :id="'image'+(index+1)" v-if="question.question_img != null">
                <div class="question-img-block">
                   <span class="question">Q.</span>
                  <img :src="'../images/questions/'+question.question_img" class="img-responsive" alt="question-image">
                </div>
              </div>

        
          <div class="col-lg-12 col-md-12 col-sm-12" style="margin-top: 20px;">
          <form class="myForm" action="/quiz_start" v-on:submit.prevent="createQuestion(question.id, question.answer, auth.id, question.topic_id)" method="post">
            <input required="" class="radioBtn" v-bind:id="'radio'+ index" type="radio" v-model="result.user_answer" value="A" aria-checked="false"> <span>{{question.a}}</span>
            <input required="" class="radioBtn" v-bind:id="'radio'+ index+1" type="radio" v-model="result.user_answer" value="B" aria-checked="false"> <span>{{question.b}}</span>
            <input required="" class="radioBtn" v-bind:id="'radio'+ index+2" type="radio" v-model="result.user_answer" value="C" aria-checked="false"> <span>{{question.c}}</span>
            <input required="" class="radioBtn" v-bind:id="'radio'+ index+3" type="radio" v-model="result.user_answer" value="D" aria-checked="false"> <span>{{question.d}}</span>
            <input required="" class="radioBtn" v-bind:id="'radio'+ index+4" type="radio" v-model="result.user_answer" value="E" aria-checked="false"> <span>{{question.e}}</span>
            <input class="radioBtn" v-bind:id="'radio'+ index+5" type="radio" v-model="result.user_answer" value="F" aria-checked="false"> <span>{{question.f}}</span>
              
            <div class="row">
              <div class="col-md-6 col-xs-8">
                <button type="submit" class="btn btn-wave btn-block nextbtn">Next</button>
              </div>
            </div>
          </form>
        </div>
        </div>
        
      </div>
    </div>
  </div>
</template>
<script>
export default {

  props: ['topic_id'],

  data () {
    return {
      questions: [],
      answers: [],
      result: {
        question_id: '',
        answer: '',
        user_id: '',
        user_answer: 0,
        topic_id: '',
      },
      auth: [],
    }
  },

  created () {
    this.fetchQuestions();
  },

  methods: {

    fetchQuestions() {
      this.$http.get(`${this.$props.topic_id}/quiz/${this.$props.topic_id}`).then(response => {
        this.questions = response.data.questions;
        this.auth = response.data.auth;
      }).catch((e) => {
        console.log(e)
      });
    },

    createQuestion(id, ans, user_id, topic_id) {
      this.result.question_id = id;
      this.result.answer = ans;
      this.result.user_id = user_id;
      this.result.topic_id = this.$props.topic_id;
      this.$http.post(`${this.$props.topic_id}/quiz`, this.result).then((response) => {
        console.log('request completed');
      }).catch((e) => {
        console.log(e);
      });
      this.result.user_answer = 0;
      this.result.topic_id = '';
    }
  }
}
</script>