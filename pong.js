var animate = window.requestAnimationFrame || 
	window.webkitRequestAnimationFrame || 
	window.mozRequestAnimationFrame || 
	function(callback) { 
		window.setTimeout(callback, 1000/60) 
	};

var canvas = document.getElementById('canvas');
var width = $(window).width();
var height = $(window).height();
canvas.width = width;
canvas.height = height;
var context = canvas.getContext('2d');

window.onload = function() {
  document.body.appendChild(canvas);
  animate(game);
};

var game = function() {
	update();
	render();
	animate(game);
}
