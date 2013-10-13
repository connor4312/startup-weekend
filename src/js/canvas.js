$(function () {
	var container = $("#canvas"),
		height = 1240,
		width = 960,
		paper = Raphael(container[0], width, height),
		colorHex = $("#colorHex"),
		imageUrl = $("#imageUrl"),
		pickerContainer = $("#pickerContainer"),
		pickerCanvas = $("#pickerCanvas"),
		elements = [],
		current = null,
		key, i, colorPicker;

	paper.canvas.style.backgroundColor = "#f2f2f2";
	key = document.getElementById("canvas").getAttribute("data-key");

	function startDrag() {
		this.ox = this.attr("x");
		this.oy = this.attr("y");
	}

	function move(dx, dy) {
		var x = this.ox + dx,
			y = this.oy + dy;

		x = Math.min(width - this.attr("width") - 10, x);
		x = Math.max(10, x);
		y = Math.min(height - this.attr("height") - 10, y);
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

	function stopDrag(event) {
		resetGlow(this, this.selected);
	}

	function resetGlow(element, selected) {
		if (element._glow) {
			element._glow.remove();
		}

		element._glow = element.glow({
			color: selected ? "#21a3c9" : "#000000"
		});
	}

	function deselect(element) {
		if (!element) {
			return;
		}

		element.selected = false;
		resetGlow(element, false);
		current = null;
	}

	function select(element) {
		element.selected = true;
		resetGlow(element, true);
		current = element;
	}

	function moveCurrent(forward) {
		var index = current._index,
			next = elements.splice(forward ? index + 1 : index - 1, 1)[0];

		current._index = forward ? current._index + 1 : current._index - 1;
		next._index = forward ? next._index - 1 : next._index + 1;

		current[forward ? "insertAfter" : "insertBefore"](next);
		elements.splice(next._index, 0, next);
		resetGlow(current, current.selected);
	}

	function moveCurrentBack(event) {
		event.preventDefault();
		if (elements.length < 2 || !current || current._index === 0) {
			return;
		}

		moveCurrent(false)
	}

	function moveCurrentForward() {
		event.preventDefault();
		if (elements.length < 2 || !current || current._index === elements.length - 1) {
			return;
		}

		moveCurrent(true);
	}

	$(paper.canvas).click(function () {
		deselect(current);
	});

	function initializeElement(element) {
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

	function addImage(response) {
		var data = response.data ? response.data[0] : response,
			container = paper.rect(data.x || 200, data.y || 200, data.width, data.height);

		container.attr({
			cursor: "move",
			stroke: "#FFF",
			"stroke-width": 10,
			fill: "url(" + unescape(data.url) + ")"
		});

		container._type = "image";
		container._width = data.width;
		container._height = data.height;
		container._url = data.url;

		initializeElement(container);

		$("#image").modal("hide");
		$("#imageupload").modal("hide");
		imageUrl.val("");
	}

	function save(event) {
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

	function onColorChange (item) {
		return function (clr) {
			colorHex.val(clr.replace(/^#(.)\1(.)\2(.)\3$/, "#$1$2$3"));
			item.color(clr);
			colorHex.css({
				background: clr,
				color: Raphael.rgb2hsb(clr).b < .5 ? "#FFF" : "#000"
			});
		};
	}

	function addColor(data) {
		var y = data.y || 200,
			x = data.x || 200,
			hext = data.color || colorHex.val(),
			rectangle = paper.rect(x, y: 200, 200, 200);

		rectangle.attr({
			fill: hex,
			cursor: "move",
			stroke: "#FFF",
			"stroke-width": 10
		});

		rectangle._type = "color";
		rectangle._hex = hex;

		initializeElement(rectangle);

		pickerContainer.hide();
		colorPicker.color("#eee");
		colorHex.css({
			background: "#FFF",
			color: "#000"
		});
		colorHex.val("#eee");
	}

	function loadElements(data) {
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

	pickerContainer.hide();

	$("#addColorButton").click(function (event) {
		event.preventDefault();
		addColor();
	});

	$("#moveBackButton").click(moveCurrentBack);
	$("#moveForwardButton").click(moveCurrentForward);

	$("#addImageButton").click(function (event) {
		event.preventDefault();
		$.ajax({
			url: "/api/image/upload?board=" + key + "&type=url&url=" + imageUrl.val(),
			method: "GET",
			success: addImage,
			error: function (message) {
				console.log("There was an error");
			}
		});
	});

	$("#imageUpload").ajaxForm(addImage);
	$("#imageUploadButton").click(function () {
		this.disabled = true;
	});

	$("#addColor").click(function (event) {
		event.preventDefault();
		if (!colorPicker) {
			colorPicker = Raphael.colorpicker(0, 0, $('#left-nav').innerWidth() - 1, "#EEE", document.getElementById("pickerCanvas"));
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