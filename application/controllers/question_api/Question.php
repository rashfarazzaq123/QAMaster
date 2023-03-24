<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Question extends \Restserver\Libraries\REST_Controller {

	// load the constructor
	public function __construct() {

        parent::__construct();
        $this->load->model('questions');
		$this->load->model('users');

    }

	public function index_get() {

	}

	// add questions to the platform
	public function question_post() {

		$username = $this->session->username;
		
		$title = $this->post('topic');

		$question = $this->post('content');

		$topic_category = $this->post('keyword');

		if($this->users->is_logged_in() == true) {

			$response = $this->questions->questionPost($username, $title, $question, $topic_category);

			if(!$response) {

				$res = "204 HTTP_NO_CONTENT";

				$this->set_response($res, \Restserver\Libraries\REST_Controller::HTTP_NO_CONTENT); 
			
			} else {

				$res = "201 HTTP CREATED";
				
				$this->set_response($res, \Restserver\Libraries\REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code

			}

		} else {

			$res = "401 Unauthorized";	

			$this->set_response($res, \Restserver\Libraries\REST_Controller::HTTP_UNAUTHORIZED); // CREATED (401) unauthorized to access the requested resource

		}	

	}

	
	public function question_get() {

		if($this->users->is_logged_in() == true) {

			$response = $this->questions->allQuestionGet();
			
			$this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK); // CREATED (201) being the HTTP response code

		} else {

			$res = "401 Unauthorized";	

			$this->set_response($res, \Restserver\Libraries\REST_Controller::HTTP_UNAUTHORIZED); // CREATED (401) unauthorized to access the requested resource

		}	

	}

	public function question_delete($question_id) {

		$username = $this->session->username;

		if($this->users->is_logged_in() == true) {

			$response = $this->questions->questionDelete($question_id, $username);

			if(!$response) {

				$this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_NO_CONTENT);
			
			} else {

				$res = "200 OK";
			
				$this->set_response($res, \Restserver\Libraries\REST_Controller::HTTP_OK); // CREATED (201) being the HTTP response code
			}

		
		} else {

			$res = "401 Unauthorized";	

			$this->set_response($res, \Restserver\Libraries\REST_Controller::HTTP_UNAUTHORIZED); // CREATED (401) unauthorized to access the requested resource

		}	

	}


	public function question_put($question_id) {

		$username = $this->session->username;
		
		$updated_title = $this->put('topic');

		$updated_question = $this->put('content'); 

		$updated_topic_category = $this->put('keyword');

		if($this->users->is_logged_in() == true) {

			$response = $this->questions->questionPut($username, $question_id, $updated_title, $updated_question, $updated_topic_category);

			if(!$response) {

				$res = "204 HTTP_NO_CONTENT";

				$this->set_response($res, \Restserver\Libraries\REST_Controller::HTTP_NO_CONTENT); 
			
			} else {

				$res = "201 HTTP CREATED";
				
				$this->set_response($res, \Restserver\Libraries\REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code

			}

		} else {

			$res = "401 Unauthorized";	

			$this->set_response($res, \Restserver\Libraries\REST_Controller::HTTP_UNAUTHORIZED); // CREATED (401) unauthorized to access the requested resource

		}	

	}

	
	public function answer_post() {

		$username = $this->session->username;
		
		$question_id = $this->post('questionId');

		$answer = $this->post('answer');

		if($this->users->is_logged_in() == true) {

			$response = $this->questions->answerPost($username, $question_id, $answer);

			if(!$response) {

				$res = "204 HTTP_NO_CONTENT";

				$this->set_response($res, \Restserver\Libraries\REST_Controller::HTTP_NO_CONTENT); 
			
			} else {

				$res = "201 HTTP CREATED";
				
				$this->set_response($res, \Restserver\Libraries\REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code

			}


			$res = "201 HTTP CREATED";
			
			$this->set_response($res, \Restserver\Libraries\REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code


		} else {

			$res = "401 Unauthorized";	

			$this->set_response($res, \Restserver\Libraries\REST_Controller::HTTP_UNAUTHORIZED); // CREATED (401) unauthorized to access the requested resource

		}	

	}

	public function answer_delete($answer_id) {

		$username = $this->session->username;

		if($this->users->is_logged_in() == true) {

			$response = $this->questions->answerDelete($answer_id, $username);

			if(!$response) {

				$this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_NO_CONTENT);
			
			} else {

				$res = "200 OK";
			
				$this->set_response($res, \Restserver\Libraries\REST_Controller::HTTP_OK); // CREATED (201) being the HTTP response code
			}


		} else {

			$res = "401 Unauthorized";	

			$this->set_response($res, \Restserver\Libraries\REST_Controller::HTTP_UNAUTHORIZED); // CREATED (401) unauthorized to access the requested resource

		}	

	}
	
	public function answer_put() {

		$username = $this->session->username;

		$answer_id = $this->put('answerId');

		$updated_answer = $this->put('updated_answer');

		if($this->users->is_logged_in() == true) {

			$response = $this->questions->answerPut($username, $answer_id, $updated_answer);

			if(!$response) {

				$res = "204 HTTP_NO_CONTENT";

				$this->set_response($res, \Restserver\Libraries\REST_Controller::HTTP_NO_CONTENT); 
			
			} else {

				$res = "201 HTTP CREATED";
				
				$this->set_response($res, \Restserver\Libraries\REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code

			}


		} else {

			$res = "401 Unauthorized";	

			$this->set_response($res, \Restserver\Libraries\REST_Controller::HTTP_UNAUTHORIZED); // CREATED (401) unauthorized to access the requested resource

		}	

	}

	public function answer_get() {

		$question_id = $this->input->get('questionID')[0];

		//var_dump("dump", $question_id);

		if($this->users->is_logged_in() == true) {

			$response = $this->questions->allAnswerGet($question_id);
			
			$this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK); // CREATED (201) being the HTTP response code

		} else {

			$res = "401 Unauthorized";	

			$this->set_response($res, \Restserver\Libraries\REST_Controller::HTTP_UNAUTHORIZED); // CREATED (401) unauthorized to access the requested resource

		}	

	}

	
	public function vote_put() {

		$answer_id = $this->put('answerId');
		$isUpVote = $this->put('isUpVote');

		if($this->users->is_logged_in() == true) {

			$response = $this->questions->votePut($isUpVote, $answer_id);

			if(!$response) {

				$res = "204 HTTP_NO_CONTENT";

				$this->set_response($res, \Restserver\Libraries\REST_Controller::HTTP_NO_CONTENT); 
			
			} else {

				$res = "201 HTTP CREATED";
				
				$this->set_response($res, \Restserver\Libraries\REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code

			}

		} else {

			$res = "401 Unauthorized";	

			$this->set_response($res, \Restserver\Libraries\REST_Controller::HTTP_UNAUTHORIZED); // CREATED (401) unauthorized to access the requested resource

		}	

	}


	public function vote_get($isUpVote) {

		$answer_id = $this->put('answerId');

		if($this->users->is_logged_in() == true) {

			$response = $this->questions->voteGet($isUpVote, $answer_id);
			
			$this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK); // CREATED (201) being the HTTP response code

		} else {

			$res = "401 Unauthorized";	

			$this->set_response($res, \Restserver\Libraries\REST_Controller::HTTP_UNAUTHORIZED); // CREATED (401) unauthorized to access the requested resource

		}	

	}


	// search functions

	public function search_get($keyword) {

		if($this->users->is_logged_in() == true) {

			$response = $this->questions->searchQuestion($keyword);
			
			$this->set_response($response, \Restserver\Libraries\REST_Controller::HTTP_OK); // CREATED (201) being the HTTP response code

		} else {

			$res = "401 Unauthorized";	

			$this->set_response($res, \Restserver\Libraries\REST_Controller::HTTP_UNAUTHORIZED); // CREATED (401) unauthorized to access the requested resource

		}	
	}

}