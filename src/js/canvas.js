/*
	TODO: Probably allow users to specify items that are currently hardcoded.
	TODO: Rename some variables/ids for consistency and readability.
	TODO: Fix pinterest.
	TODO: Select multiple elements?
	TODO: Group layers?
*/
$(function () {
	// summary:
	//		Canvas object and related controls.
	// container: Node
	//		Main div on which the canvas will be initialized.
	var container = $("#canvas"),
		// height: Number
		//		Number of pixels high that the canvas should be.
		height = 1240,
		// width: Number
		//		Number of pixels wide that the canvas should be.
		width = 960,
		// paper: Raphael.Paper
		//		SVG canvas (paper) on which the elements will be rendered.
		paper = Raphael(container[0], width, height),
		// colorHex: Node
		//		Input in which the hexidecimal value of the desired color swatch will be placed.
		colorHex = $("#colorHex"),
		// imageUrl: Node
		//		Input in which the URL value of the desired image to import will be placed.
		imageUrl = $("#imageUrl"),
		// pickerContainer: Node
		//		Main container in which the color picker will be placed.
		pickerContainer = $("#pickerContainer"),
		// pickerCanvas: Node
		//		SVG Canvas on which the color picker will be placed.
		pickerCanvas = $("#pickerCanvas"),
		// elements: Raphael.Element[]
		//		Array of elements that have been added to the canvas.
		elements = [],
		// current: Raphael.Element
		//		Element that is currently selected.  If no element is selected
		//		this value will be `null`.
		current = null,
		// dribleUrl: Node
		//		Input in which the URL value of the desired dribble bucket will be placed.
		dribbleUrl = $("#js-dribbble-bucket-in"),
		// pinterestUrl: Node
		//		Input in which the URL value of the desired pinterest board will be placed.
		pinterestUrl = $("#js-pin-in"),
		// key: String
		//		Board key.
		// i: Number
		// colorPicker: Raphael.ColorPicker
		key, i, colorPicker;

	paper.canvas.style.backgroundColor = "#f2f2f2";
	key = document.getElementById("canvas").getAttribute("data-key");

	function startDrag() {
		// summary:
		//		Function executed when the user performs the beginning of the dragging
		//		of an element.
		this.ox = this.attr("x");
		this.oy = this.attr("y");
	}

	function move(/*Number*/ dx, /*Number*/ dy) {
		// summary:
		//		Function executed as the user moves the element across the canvas.
		// dx: Number
		//		Delta change, in pixels, that the element has moved on the x-axis.
		// dy: Number
		//		Delta change, in pixels, that the element has moved on the y-axis.
		var x = this.ox + dx,
			y = this.oy + dy;

		// Contain element at top most and left most areas of the canvas.
		x = Math.min(width - this.attr("width") - 10, x);
		y = Math.min(height - this.attr("height") - 10, y);

		// Contain element at right most and bottom most areas of the canvas.
		x = Math.max(10, x);
		y = Math.max(10, y);

		this.attr({
			x: x,
			y: y
		});

		this._moving = true;

		if (this._glow) {
			this._glow.remove();
			this._glow = undefined;
		}
	}

	function stopDrag() {
		// summary:
		//		Function executed when the element has been dropped after dragging.
		resetGlow(this, this.selected);
	}

	function resetGlow(/*Raphael.Element*/ element, /*Boolean*/ selected) {
		// summary:
		//		Removes an old glow and adds a new glow to an element.
		// element: Raphael.Element
		//		Element to which the glow should be added and removed.
		// selected: Boolean
		//		If the element is in a selected state.
		if (element._glow) {
			element._glow.remove();
		}

		element._glow = element.glow({
			color: selected ? "#21a3c9" : "#000000"
		});
	}

	function deselect(/*Raphael.Element*/ element) {
		// summary:
		//		Deselect an element.  Currently only deselects the 'current' selected element.
		// element: Raphael.Element
		//		Element that should be deselected.
		if (!element || !element.selected) {
			return;
		}

		element.selected = false;
		resetGlow(element, false);
		current = null;
	}

	function select(/*Raphael.Element*/ element) {
		// summary:
		//		Select an element.  Currently will deselect any currently selected element.
		// element: Raphael.Element
		//		Element that should be selected.
		element.selected = true;
		resetGlow(element, true);
		current = element;
	}

	function moveCurrent(/*Boolean*/ forward) {
		// summary:
		//		Moves the current element in either a forward or backward direction.
		// forward: Boolean
		//		If the element should be moved forward.
		var index = current._index,
			// Completely remove the `next` element, so that it can be repositioned in the
			// `elements` array.
			next = elements.splice(forward ? index + 1 : index - 1, 1)[0];

		current._index = forward ? current._index + 1 : current._index - 1;
		next._index = forward ? next._index - 1 : next._index + 1;

		current[forward ? "insertAfter" : "insertBefore"](next);
		elements.splice(next._index, 0, next);
		resetGlow(current, current.selected);
	}

	function moveCurrentBack(/*Event*/ event) {
		// summary:
		//		Move the currently selected element backwards.
		// event: Event
		//		Event object from the click.

		// Since the move back element is an anchor with an href, we must prevent default.
		event.preventDefault();
		if (elements.length < 2 || !current || current._index === 0) {
			return;
		}

		moveCurrent(false);
	}

	function moveCurrentForward(/*Event*/ event) {
		// summary:
		//		Move the currently selected element forwards.
		// event: Event
		//		Event object from the click.

		// Since the move back element is an anchor with an href, we must prevent default.
		event.preventDefault();
		if (elements.length < 2 || !current || current._index === elements.length - 1) {
			return;
		}

		moveCurrent(true);
	}

	function initializeElement(/*Raphael.Element*/ element) {
		// summary:
		//		Initialize an element and attach appropriate event
		//		listeners to it.
		// element: Raphael.Element
		//		Element to be initialized.
		element._index = elements.length;

		element.click(function (event) {
			event.stopPropagation();

			if (this === current && !this._moving) {
				deselect(this);
			}

			if (this._moving) {
				this._moving = false;
			}
		});

		element.dblclick(function (event) {
			event.stopPropagation();
			deselect(current);
			select(this);
		});

		element._glow = element.glow();

		element.drag(move, startDrag, stopDrag);

		elements.push(element);
	}

	function addImage(/*Object*/ response) {
		// summary:
		//		Adds an image to the canvas.
		// response: Object
		//		XMLHTTP request response or an object.
		var data = response.data || response,
			i = 0,
			image, container, x, y;

		if (Object.prototype.toString.call(data) !== "[object Array]") {
			data = [data];
		}

		while (image = data[i++]) {
			x = parseInt(image.x) || 200;
			y = parseInt(image.y) || 200;
			container = paper.rect(x, y, image.width, image.height);

			container.attr({
				x: x,
				y: y,
				cursor: "move",
				stroke: "#FFF",
				"stroke-width": 10,
				fill: "url(" + unescape(image.url) + ")"
			});

			container._type = "image";
			container._width = image.width;
			container._height = image.height;
			container._url = image.url;

			initializeElement(container);
		}

		// Hide any modal that might be opened.
		$("#image").modal("hide");
		$("#imageupload").modal("hide");
		$("#dribbble").modal("hide");
		$("#pinterest").modal("hide");
		$("#addImageButton").attr("disabled", false);
		$("#imageUploadButton").attr("disabled", false);
		$("#js-dribbble-bucket-sub").attr("disabled", false);
		$("#js-pin-sub").attr("disabled", false);
		imageUrl.val("");
	}

	function save(/*Event*/ event) {
		// summary:
		//		Saves the elements of the canvas, their position,
		//		type, and size, etc.
		var data = {
				board: key
			},
			i = 0,
			elementData = [],
			element;

		event.preventDefault();

		while (element = elements[i++]) {
			elementData.push({
				type: element._type,
				x: element.attr("x"),
				y: element.attr("y"),
				width: element._width || null,
				height: element._height || null,
				url: element._url || null,
				index: element._index,
				color: element._hex || null
			});
		}

		data.elements = elementData;

		$.ajax({
			url: "/api",
			method: "POST",
			data: data,
			success: function () {
				console.log("Save successful");
			},
			error: function (message) {
				console.log("There was an error");
			}
		});
	}

	function onColorChange (/*Raphael.ColorPicker*/ item) {
		// summary:
		//		Changes the color of the input that is linked to the
		//		color picker.
		// item: Raphael.ColorPicker
		return function (clr) {
			colorHex.val(clr.replace(/^#(.)\1(.)\2(.)\3$/, "#$1$2$3"));
			item.color(clr);
			colorHex.css({
				background: clr,
				color: Raphael.rgb2hsb(clr).b < .5 ? "#FFF" : "#000"
			});
		};
	}

	function addColor(/*Object?*/ data) {
		// summary:
		//		Adds a color swatch to the canvas.
		// data: [optional] Object
		//		Optional object containing information about
		//		the swatch.
		var y = parseInt(data.y) || 200,
			x = parseInt(data.x) || 200,
			hex = data.color || colorHex.val(),
			rectangle = paper.rect(x, y, 200, 200);

		rectangle.attr({
			x: x,
			y: y,
			fill: hex,
			cursor: "move",
			stroke: "#FFF",
			"stroke-width": 10
		});

		rectangle._type = "color";
		rectangle._hex = hex;

		initializeElement(rectangle);

		pickerContainer.hide();
		if (colorPicker) {
			colorPicker.color("#eee");
			colorHex.css({
			background: "#FFF",
				color: "#000"
			});
			colorHex.val("#eee");
		}
	}

	function loadElements(/*Object[]*/ data) {
		// summary:
		//		Loads an array of element configuration objects
		//		onto the canvas.
		// data: Object[]
		//		Array of objects containing information about the
		//		element.
		var i = 0,
			element;

		while (element = data[i++]) {
			if (element.type === "color") {
				addColor(element);
			} else {
				addImage(element);
			}
		}
	}

	function fetchImage(/*String*/ url, /*String*/ type) {
		// summary:
		//		Fetches an image of a provided type at a provided location.
		// url: String
		//		Location at which the image can be found.
		// type: String
		//		Type of image: url, pinterest, dribbleBucket
		$.ajax({
			url: "/api/image/upload?board=" + key + "&type=" + type + "&url=" + url,
			method: "GET",
			success: addImage,
			error: function (message) {
				console.log("There was an error");
			}
		});
	}

	pickerContainer.hide();

	$("#addColorButton").click(function (event) {
		event.preventDefault();
		addColor();
	});

	$("#moveBackButton").click(moveCurrentBack);
	$("#moveForwardButton").click(moveCurrentForward);

	$("#addImageButton").click(function (event) {
		event.preventDefault();
		fetchImage(imageUrl.val(), "url");
		$(this).attr("disabled", true);;
	});

	$("#imageUpload").ajaxForm(addImage);
	$("#imageUploadButton").click(function () {
		$(this).attr("disabled", true);
		$("#imageUpload").submit();
	});

	$("#addColor").click(function (event) {
		var size = $("#left-nav").innerWidth() - 1,
			position = pickerCanvas.position();

		event.preventDefault();

		if (!colorPicker) {
			colorPicker = Raphael.colorpicker(position.left - size, position.top - size, size, "#EEE", pickerCanvas[0]);
			colorPicker.onchange = onColorChange(colorPicker);
			colorPicker.color("#eee");
			colorHex.val("#eee");
		}

		pickerContainer.show();
	});

	$("#selectColor").click(addColor);

	colorHex.keyup(function () {
		if (colorPicker) {
			colorWheel.color(colorHex.val());
		}
	});

	$("#saveButton").click(save);

	$("#js-dribbble-bucket-sub").click(function (event) {
		event.preventDefault();
		fetchImage(dribbleUrl.val(), "dribbbleBucket");
		$(this).attr("disabled", true);;
	});

	$("#js-pin-sub").click(function (event) {
		event.preventDefault();
		fetchImage(pinterestUrl.val(), "pinterest");
		$(this).attr("disabled", true);;
	});

	$(paper.canvas).click(function () {
		deselect(current);
	});

	$.ajax({
		url: "/api?board=" + key,
		method: "GET",
		success: function (response) {
			var data = response.data;
			if (data.length) {
				loadElements(data);
			}
		}
	});
});