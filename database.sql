CREATE TABLE user_details (
    user_detailsID varchar(225) NOT NULL,
    name varchar(30) NOT NULL,
    username varchar(10) NOT NULL,
    email varchar(255),
    password varchar(225) NOT NULL,
    PRIMARY KEY (user_detailsID)
    );

CREATE TABLE question (
    questionID varchar(225) NOT NULL,
    topic varchar(50) NOT NULL,
    content varchar(225) NOT NULL,
    keyword varchar(30) NOT NULL,
    user_detailsID varchar(225) NOT NULL,
    upvotequestion Int,
    downVotequestion Int,
    PRIMARY KEY (questionID),
    CONSTRAINT FK_user_detailsID FOREIGN KEY (user_detailsID)
    REFERENCES user_details(user_detailsID)
    );

CREATE TABLE answer (
    answerID varchar(225) NOT NULL,
    answer varchar(225) NOT NULL, 
    questionId varchar(225) NOT NULL,
    user_detailsID varchar(225) NOT NULL,
    upVoteanswer Int,
    downVoteanswer Int,
    PRIMARY KEY (answerID),
    CONSTRAINT FK_questionId FOREIGN KEY (questionID)
    REFERENCES question(questionID),
    CONSTRAINT FK_answeruser_detailsID FOREIGN KEY (user_detailsID)
    REFERENCES user_details(user_detailsID)
    );

CREATE TABLE session (
    sessionID varchar(128),
    ipAddress varchar(45),
    imestamp int(10),
    data blob,
    PRIMARY KEY (sessionID)
 );



