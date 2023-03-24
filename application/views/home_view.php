<!DOCTYPE html>
<html>

<head>
    <title>Q/A Master </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,200;0,400;0,500;0,700;1,400&display=swap"
        rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('css/style.css') ?>" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.2.3/backbone-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
</head>
<body>
     <!-- nav bar  -->
<nav class="navbar navbar-expand-lg bg-body-tertiary  fw-bold">
  <div class="container-fluid  fw-bold">
    <a class="navbar-brand  fw-bold  fs-2 text-danger  " >Q/A MASTER</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo base_url(); ?>index.php/login/logout">Logout</a>
        </li>
        <li class="nav-item  fw-bold">
          <a class="nav-link  fw-bold" href="<?php echo base_url(); ?>index.php/HomeController/">Home</a>
        </li>
    
        <li class="nav-item  fw-bold">
          <a class="nav-link  fw-bold" href="<?php echo base_url(); ?>index.php/Register">Register</a>
        </li>
      
      </ul>
      <form class="d-flex" role="search">
        <input id="searchtxt" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button id="searchbtn" class="btn btn-outline-primary" >Search</button>
      </form>
    </div>
  </div>
</nav>
    <!-- main container -->
    <div class="container p-3 mb-2 bg-primary-subtle bg-light">
    <!-- The instructions   -->
    
                        <p class="nav-link fw-bold text-danger  fs-3 " >Welcome 
                            <?php echo $this->session->userdata('username'); ?></p>
                          
                    
    <p class="text-right fs-6 fw-bold"> Please follow the informations </p>

    <div class="intro ">
		<p class = " text-right fs-6 fw-bold" > Add Question </p>
		<p class = "text-right fs-7  " >Please add the Topic name , content , Keyword of your technical question.User can use following keywords as example :JAVA , PHP, PYTHON etc 
        User can click the post button to post questions.The post question will be display in the table </p>
		<p class = " text-right fs-6 fw-bold" > Update Question </p>
		<p class = "text-right fs-7  " >Please add the question Id Topic name , content , Keyword for the question that have to 
            be updated .Click the update question button </p>
		
		<p class = " text-right fs-6 fw-bold" > Add Answer </p>
		<p class = " " >Please add the question id in the question ID text box the question ID can be taken by the 
            table.To add answer plase use the post Answer text box and click the post answer button   </p>
	
		<p class = "text-right fs-6 fw-bold " > View Answer </p>
		<p class = " " >Use View answers button by providing the question id (Question id can be taken form the table ).The Answer what you have added and the already answers will be display relevent to the question in the table   </p>

        <p class = " text-right fs-6 fw-bold" > Search question </p>
		<p class = " " >Please type the keyword in the search bar.Click search button  </p>
	
	</div>

    <hr>
        <!-- add question form --->

        <p class="text-center fs-1 text-danger fw-bold ">  Welcome to Q/A MASTER </p>

        <div class="question-form" id="question-form">
            <div class="col-sm-8">
                <div class="mb-3">
                 
                    <label for="exampleFormControlInput1" class="form-label">Question topic</label>
                    <input type="email" class="form-control" id="question-topic" >

                    <label for="exampleFormControlInput1" class="form-label">Question ID </label>
                    <input type="email" class="form-control" id="txtQuestionId" >
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Content </label>
                    <textarea class="form-control" id="question-content" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Category </label>
                    <input type="email" class="form-control" id="question-category" >
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Post Answers</label>
                    <input type="email" class="form-control" id="txtComments" >
                </div>
                <div class="col-auto">
                    <button type="submit" id="loadQuestionBtn" class="btn btn-primary mb-3">Load Question</button> &nbsp;
                    <button type="submit" id="postQuestionBtn" class="btn btn-primary mb-3">Post Question</button> &nbsp;

                    <button type="submit" id="btnViewComments" class="btn btn-primary mb-3">View Answers</button> &nbsp;
                    <button type="submit" id="btnPostComments" class="btn btn-primary mb-3">Post Answers</button>&nbsp;

                </div>
            </div>
        </div>
<br>

        <!-- view all questions --->
        <div class="question-view ">
            <div id="contentarea">
                <table class="table table-striped-columns">

                    <thead>
                        <tr>
                            <th scope="col" class="th-q text-danger">Questions</th>
                            <th scope="col"  class="th-a text-danger">Answers</th>
                        </tr>
                    </thead>

                    <tbody>

                    <tr>
                        <td id="questionarea">

                        </td>

                        <td id="answerarea">

                        </td>

                    </tr>

                    </tbody>
                    
                </table>

            </div>
            <div id="contentarea2"></div>
        </div>
    </div>
    <script type="text/javascript" lang="javascript">
            $(document).ready(function () {
                $('#btnViewComments').click(function (event) {
                    event.preventDefault();
                    doSubmitREST();
                });
            });
            $(document).ready(function () {
                $('#searchbtn').click(function (event) {
                    event.preventDefault();
                    search();
                });
            });
            $(document).ready(function () {
                $('#loadQuestionBtn').click(function (event) {
                    event.preventDefault();
                    loadQuestions();
                });
            });
    </script>   

    <!-- question template -->
    <script id="questionTemplate" type="text/template">
    <div class=" shadow p-3 mb-5 bg-body-tertiary rounded p-3 mb-2 bg-primary-subtle text-emphasis-primary">
                <div class = "fw-bold"> User: <%= user_detailsID %>  &nbsp; || Question ID: <%= questionID %>  </div>
                <div class ="text-right fw-bold ">Category: <%= keyword %></div>

                <div class =" fw-bold fs-5"><%= topic %></div>
                <hr>
                Content :
                <div ><%= content %></div>
                </div>  
                <button type="submit" id="deleteQuestion" class="btn btn-danger mb-3">Delete Question</button> &nbsp;
                <button id="uptQuestionBtn" class="btn btn-primary mb-3">Update Question</button> &nbsp;
                <hr> 
       
    </script>

    <!-- answer template -->
    <script id="answerTemplate" type="text/template">
 
    <div class=" shadow p-3 mb-5 bg-body-tertiary rounded p-3 mb-2 bg-primary-subtle text-emphasis-primary "> 
    <div class =" fw-bold fs-6"> Answer ID :<%= answerID %> </div>
    <br>
    <div class ="text-right "><%= answer %> </div>
        <button type="submit" id="deleteAnswer" class="btn btn-danger mb-3">Delete Answer</button> &nbsp;

</div>
<hr>
 
    </script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
    // animation 
    AOS.init({
        duration: 1200,
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"
        integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous">
    </script>
    <script src="<?php echo base_url('js/backbone.js') ?>"></script>

</body>

</html>