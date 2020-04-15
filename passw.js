function myFunction() {
	// Javascript file 	get the textbox via javascript when moving the mouse over it and change its type to text(password field) underlogin.
	//https://stackoverflow.com/questions/15140011/how-do-i-combine-html-css-and-javascript-coding-to-make-my-carousel-work
	
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
} 