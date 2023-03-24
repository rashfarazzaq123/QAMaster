<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Questions extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function questionPost($username, $title, $question, $topic_category){

        $user_id = $this->db->select('user_detailsID')->get_where('user_details', array('username' => $username))->result()[0]->user_detailsID;
       
        $questionID = mt_rand(1,999999);
        
        if ($title == null or $question  == null or $topic_category == null) {
    
            return false;
        } else {
        
            if ($this->db->insert('question',
        
            array('questionID' => $questionID, 'topic' => $title, 'content' => $question, 'keyword' => $topic_category, 'user_detailsID' => $user_id ,'upvoteQuestion' => 0, 'downVoteQuestion' => 0 ))){
                return True;
            }
            else {
                return False;
            }

        }
    
    }


    function questionGet($username){

        $user_id = $this->db->select('user_detailsID')->get_where('user_details', array('username' => $username))->result()[0]->user_detailsID;

        $response = $this->db->select('*')->get_where('question', array('user_detailsID' => $user_id))->result();

        return $response;

    }


    function allQuestionGet(){

        $response = $this->db->get('question')->result();

        return $response;

    }



    function questionDelete($question_id, $username){

        $user_id = $this->db->select('user_detailsID')->get_where('user_details', array('username' => $username))->result()[0]->user_detailsID;

        $query = "DELETE FROM question WHERE user_detailsID = $user_id AND questionID = $question_id";

        $response = $this->db->query($query);

        return $response;

    }

    function questionPut($username, $question_id, $updated_title, $updated_question, $updated_topic_category){

        $user_id = $this->db->select('user_detailsID')->get_where('user_details', array('username' => $username))->result()[0]->user_detailsID;

        $this->db->where(array('user_detailsID' => $user_id, 'questionID' => $question_id));

        if ($this->db->update('question', array('topic' => $updated_title, 'content' => $updated_question, 'keyword' => $updated_topic_category ))){
                return True;
            }
            else {
                return False;
            }

    }


    function answerPost($username, $question_id, $answer){

        $user_id = $this->db->select('user_detailsID')->get_where('user_details', array('username' => $username))->result()[0]->user_detailsID;
       
        $answer_id = mt_rand(1,999999);
        var_dump($question_id, $answer);
        if ($question_id == null or $answer  == null) {
            
            return false;

        } else {
        
            if ($this->db->insert('answer',
        
            array('answerID' => $answer_id, 'answer' => $answer, 'questionId' => $question_id, 'user_detailsID' => $user_id, 'upVoteAnswer' => 0, 'downVoteAnswer' => 0))){
                
                return True;
            }
            
            else {
                
                return False;
            }

        }
    
    }

    function answerDelete($answer_id, $username){

        $user_id = $this->db->select('user_detailsID')->get_where('user_details', array('username' => $username))->result()[0]->user_detailsID;

        $query = "DELETE FROM answer WHERE user_detailsID = $user_id AND answerID = $answer_id";

        $response = $this->db->query($query);

        return $response;

    }


    function answerPut($username, $answer_id, $updated_answer){

        $user_id = $this->db->select('user_detailsID')->get_where('user_details', array('username' => $username))->result()[0]->user_detailsID;

        $this->db->where(array('user_detailsID' => $user_id, 'answerID' => $answer_id));

        if ($this->db->update('answer', array('answer' => $updated_answer))){
                return True;
            }
            else {
                return False;
            }

    }

    function allAnswerGet($questionID){

        $this->db->where(array('questionID' => $questionID));

        $response = $this->db->get('answer')->result();

        return $response;

    }

    function votePut($isUpVote, $answer_id) {

        $upVoteCount = $this->db->select('upVoteAnswer')->get_where('answer', array('answerID' => $answer_id))->result()[0]->upVoteAnswer;

        $downVoteCount = $this->db->select('downVoteAnswer')->get_where('answer', array('answerID' => $answer_id))->result()[0]->downVoteAnswer;

        if ($isUpVote == true) {

            $upVoteCount = $upVoteCount + 1;

            $this->db->where(array('answerID' => $answer_id));
            
            if ($this->db->update('answer', array('upVoteAnswer' => $upVoteCount))){
                
                return True;
            }
            
            else {
                
                return False;
            }

        } else {

            $downVoteCount = $downVoteCount + 1;

            $this->db->where(array('answerID' => $answer_id));
            
            if ($this->db->update('answer', array('downVoteAnswer' => $downVoteCount))){
                
                return True;
            }
            
            else {
                
                return False;
            }

        }

    }

    function voteGet($isUpVote, $answer_id) {

        if ($isUpVote == true) {

            $upVoteCount = $this->db->select('upVoteAnswer')->get_where('answer', array('answerID' => $answer_id))->result();

            return $upVoteCount;

        } else {

            $downVoteCount = $this->db->select('downVoteAnswer')->get_where('answer', array('answerID' => $answer_id))->result();
        
            return $downVoteCount;
        }       

    }

    function searchQuestion($keyword) {

        $response = $this->db->select('*')->get_where('question', array('keyword' => $keyword))->result();

        return $response;

    }

}