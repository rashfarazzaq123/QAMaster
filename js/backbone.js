var questionItem = Backbone.Model.extend({ // define the question model
	urlRoot: "/cw2/index.php/question_api/question/question",
	idAttribute: 'questionID',
	defaults: {
		topic: '',
		content: '',
		keyword: '',
		upvotequestion: '',
		downVotequestion: '',
	},
	
});

var questionItemCollection = Backbone.Collection.extend({ // create a collection of the question model items
	url: "/cw2/index.php/question_api/question/question",
	model: questionItem
});

var itemCollection = new questionItemCollection(); 

var answerItem = Backbone.Model.extend({ // define the question model
	urlRoot: "/cw2/index.php/question_api/question/answer",
	idAttribute:'answerID',
	defaults: {
		answer: '',
		upVoteanswer: '',
		downVoteanswer: '',
		questionId: ''
	},
});
var answerItemCollection = Backbone.Collection.extend({ 
	url: "/cw2/index.php/question_api/question/answer",
	model: answerItem
});


var ansItemCollection = new answerItemCollection(); 


var answerGetView = Backbone.View.extend({ // create a new view to display the question using template
	// define the attributes
	model: new answerItem(),
	template: $("#answerTemplate").html(),
	events: {
		"click #deleteAnswer": 'deleteWish'
	},

	deleteWish: function () {
		if (confirm("Delete Question ?")) {
			this.model.destroy({
				success: function (response) {
					console.log('Deleted');
				},
				error: function (err) {
					alert("Error :unable to delete!");
				}
			});
			;
		}
	},
	// render the template with model data
	render: function () {
		var tmpl = _.template(this.template);
		var View = this.model.toJSON();
		$(this.el).html(tmpl(View));
		return this;
	}
});

var QuestionGetView = Backbone.View.extend({ // create a new view to display the question using template
	model: new questionItem(),
	template: $("#questionTemplate").html(),

	events: {
		"click #deleteQuestion": 'deleteWish',
		"click #uptQuestionBtn": 'updateQuestion'
	},

	deleteWish: function () {
		if (confirm("Delete Question?")) {
			this.model.destroy({
				success: function (response) {
					console.log('Deleted',response);
				},
				error: function (err) {
					alert("Delete the answers first releted for this question ");
				}
			});
			;
		}
	},
	updateQuestion: function () {
		console.log("Update Question");

		this.model.set('topic', $('#question-topic').val());
		this.model.set('content', $('#question-content').val());
		this.model.set('keyword', $('#question-category').val());

		this.model.save(null, {
			success: function (response) {
				console.log("Save",response);
				itemCollection.fetch();
			},
			error: function (err) {
				alert("Error : unable to update wish!");
			}
		});
	},

	render: function () {
		var tmpl = _.template(this.template);
		var View = this.model.toJSON();
		$(this.el).html(tmpl(View));
		return this;
	}
});
var answerListView = Backbone.View.extend({ 
		model: ansItemCollection,
		el: $('#answerarea'),
		
		initialize: function (questionID) {
			var self = this;
			this.model.on('add', this.render, this);
			this.model.on('change', function () {
				setTimeout(function () {
					self.render();
				}, 30);
			}, this);
			this.model.on('remove', this.render, this);
			var propertyValues = Object.values(questionID);
			this.model.fetch({ contentType: 'application/json', data: {questionID: propertyValues}})
		},
		render: function () {
			this.$el.empty()
			_.each(this.model.models, function (item) {
				console.log(item);
				var answerGetview = new answerGetView({model: item});
				this.$el.append(answerGetview.render().el);
			}, this);
		}
});


function doSubmitREST(){

	var searchItem = $('#txtQuestionId').val();
	console.log(searchItem);

	itemCollection.fetch({
		success: function (response) {
			_.each(response.toJSON(), function (item) {
				console.log('Success : ' + item.questionID);
				if (item.questionID == searchItem) {
					var answergetView = new answerListView({questionID: item.questionID});
				}
				
			})
		},
		error: function () {
			console.log('Failed ');
		}
	});

}

var questionListView = Backbone.View.extend({ 
		model: itemCollection,
		el: $('#questionarea'),

		initialize: function () {
			var self = this;
			this.model.on('add', this.render, this);
			this.model.on('change', function () {
				setTimeout(function () {
					self.render();
				}, 30);
			}, this);
			this.model.on('remove', this.render, this);
			this.model.fetch({
				success: function (response) {
					_.each(response.toJSON(), function (item) {
						console.log('Success : ' + item.questionID);
					})
				},
				error: function () {
					console.log('Failed ');
				}
			});
			
		},
		render: function () {
			
			this.$el.empty()
			_.each(this.model.models, function (item) {
				var questionGetView = new QuestionGetView({model: item});
				this.$el.append(questionGetView.render().el);
			}, this);
		}
});

var listview = new questionListView(); // create a object with questionListView to show all the questions on view


var postQuestion = Backbone.View.extend({ // create a new view to post the question
		model: new questionItem(),
		el: $('#question-form'),
		
		initialize: function () {},
		render: function () {return this;},
		events: {"click #postQuestionBtn": 'postQuestion'},

		postQuestion: function () {
			
			this.model.set('topic', $('#question-topic').val());
			this.model.set('content', $('#question-content').val());
			this.model.set('keyword', $('#question-category').val());

			this.model.save(null, {
				success: function (response) {
					console.log(response);
					itemCollection.fetch();
				},
				error: function (err) {
					alert("Error : Erro on posting the question!");
				}
			});

		},
});


var postQuestions = new postQuestion(); // create a new object with the post questions view


// ------------------------------------------------
var postAnswers = Backbone.View.extend({ // create a new view to post the question
	model: new answerItem(),
	el: $('#question-form'),
	
	initialize: function () {},
	render: function () {return this;},
	events: {"click #btnPostComments": 'postAnswers'},

	postAnswers: function () {
		
		this.model.set('answer', $('#txtComments').val());
		this.model.set('questionId', $('#txtQuestionId').val());
		this.model.save(null, {
			success: function (response) {
				console.log("minu",response);
				ansItemCollection.fetch();
				doSubmitREST();
			},
			error: function (err) {
			}
		});

	},
});


var postanswers = new postAnswers(); // create a new object with the post questions view

var questionListViewUpdated = Backbone.View.extend({ // create a new view to display the question on questionlist template,
	model: itemCollection,
	el: $('#questionarea'),
	
	initialize: function (found) {
		var self = this;
		this.model.on('add', this.render, this);
		this.model.on('change', function () {
			setTimeout(function () {
				self.render();
			}, 30);
		}, this);
		this.model.on('remove', this.render, this);
		//console.log(found);
		this.model.set(found);
	},
	render: function () {
		this.$el.empty()
		_.each(this.model.models, function (item) {
			var questionGetView = new QuestionGetView({model: item});
			this.$el.append(questionGetView.render().el);
		}, this);
	}
});



function search(){

	var searchItem = $('#searchtxt').val();
	console.log(searchItem);

	var found = itemCollection.findWhere({'keyword': searchItem});
	console.log("found", found);
	
	var foundItem = new questionListViewUpdated(found);
	foundItem.render
}

function loadQuestions(){
	var listview = new questionListView(); // create a object with questionListView to show all the questions on view
}





