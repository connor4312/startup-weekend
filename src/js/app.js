
/**
 * Defines theme colors used in the application
 */
var colors = {
	base03: {r: 0, g: 43, b: 54},
	base02: {r: 7, g: 54, b: 66},
	base01: {r: 88, g: 110, b: 117},
	base00: {r: 101, g: 123, b: 131},
	base0: {r: 131, g: 148, b: 150},
	base1: {r: 147, g: 161, b: 161},
	base2: {r: 238, g: 232, b: 213},
	base3: {r: 253, g: 246, b: 227},
	yellow: {r: 181, g: 137, b: 0},
	orange: {r: 203, g: 75, b: 22},
	red: {r: 220, g: 50, b: 47},
	magenta: {r: 211, g: 54, b: 130},
	violet: {r: 108, g: 113, b: 196},
	blue: {r: 38, g: 139, b: 210},
	cyan: {r: 42, g: 161, b: 152},
	green: {r: 133, g: 153, b: 0}
}

/**
 * Initializes the container and base variables
 */
var width = 800;
var height = 600;

var stage = new Kinetic.Stage({
	container: 'container',
	width: width,
	height: height
});

/**
 * Creates the background and grid
 */
var backDrop = new Kinetic.Layer();

var bg = new Kinetic.Rect({
	width: width,
	height: height,
	fillRGB: colors.base3
});

backDrop.add(bg);

for (i = 0; i < width; i += 10) {

	if (Math.floor(i/50) == i/50) {
		color = colors.base00;
		length = 10;
	} else {
		color = colors.base2;
		length = 5;
	}


	var line = new Kinetic.Line({
		points: [ [i, 0], [i, length] ],
		strokeRGB: color,
		strokeWidth: 1
	});
	backDrop.add(line);
}
for (i = 0; i < height; i += 10) {

	if (Math.floor(i/50) == i/50) {
		color = colors.base00;
		length = 10;
	} else {
		color = colors.base2;
		length = 5;
	}


	var line = new Kinetic.Line({
		points: [ [0, i], [length, i] ],
		strokeRGB: color,
		strokeWidth: 1
	});
	backDrop.add(line);
}

/**
 * Functional class for grid management
 */
function jsonConcat(o1, o2) {
	for (var key in o2) {
		o1[key] = o2[key];
	}
	return o1;
}

var layers = function() {
	
}

var API = function() {
	this.update = function(id, type, parameters) {
		$.ajax({
			type: "POST",
			url: window.baseurl + '/api/' + type + '/' + id + '/edit',
			data: parameters
		});
	};
	this.create = function(type, parameters) {
		$.ajax({
			type: "POST",
			url: window.baseurl + '/api/' + type + '/' + id + '/edit',
			data: parameters
		});
	};
	this.delete = function(id) {
		$.ajax({
			type: "DELETE",
			url: window.baseurl + '/api/' + type + '/' + id,
			data: parameters
		});
	};
	this.get = function(type, id, oncomplete) {
		$.ajax({
			type: "GET",
			url: window.baseurl + '/api/' + type + '/' + id,
			data: parameters
		}).done(oncomplete);
	};
	this.list = function(type, oncomplete) {
		$.ajax({
			type: "GET",
			url: window.baseurl + '/api/' + type,
			data: parameters
		}).done(oncomplete);
	};
};

function genericObject (me, parameters) {
	this.defaults = {
		x: width/2,
		y: height/2,
		draggable: true,
		strokeRGB: colors.cyan,
		strokeWidth: 2
	};

	this.selected = false;

	this.init = function() {
		this.kinet = new Kinetic[this.type](jsonConcat(this.defaults, parameters));
		this.kinet.disableStroke();

		this.kinet.on('dragend', function() {
			API.update(this.id, this.dbt, this.updateFunc());
		});

		this.kinet.on('click', function() {
			this.selected = true;
			this.kinet.enableStroke();
		});
	};
};

function objectImage () {
	var self = this;
	this.type = 'Image';
	this.dbt = 'image';

	genericObject.call(this);
	this.init();

	this.updateFunc = function() {
		return {
			x: self.kinet.getPosition().x,
			y: self.kinet.getPosition().y,
			xscale: self.kinet.getScale().x,
			yscale: self.kinet.getScale().y,
			url: self.getImage().src,
		};
	};
};
objectImage.prototype = new genericObject();
objectImage.prototype.constructor = objectImage;

function objectText() {
	var self = this;
	this.type = 'Text';
	this.dbt = 'text';

	genericObject.call(this);
	this.init();

	this.updateFunc = function() {
		return {
			x: self.kinet.getPosition().x,
			y: self.kinet.getPosition().y,
			xscale: self.kinet.getScale().x,
			yscale: self.kinet.getScale().y,
			font: self.kinet.getFontFamily(),
			size: self.kinet.getFontFamily(),
		};
	};
};
objectText.prototype = new genericObject();
objectText.prototype.constructor = objectText;

function objectColor() {
	var self = this;
	this.type = 'Rect';
	this.dbt = 'color';

	genericObject.call(this);
	this.init();

	this.updateFunc = function() {
		return {
			x: self.kinet.getPosition().x,
			y: self.kinet.getPosition().y,
			xscale: self.kinet.getScale().x,
			yscale: self.kinet.getScale().y,
			color: self.kinet.getFillRGB().join(',')
		};
	};
};
objectColor.prototype = new genericObject();
objectColor.prototype.constructor = objectColor;

var circle = new objectColor({
	fillRGB: color.orange
});

backDrop.add(circle.kinet);
stage.add(backDrop);