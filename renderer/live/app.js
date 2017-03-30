const Editor = function(id, containerId) {
	if (undefined === containerId)
		containerId = id + '-container'
	this.id = id
	this.container = document.getElementById(containerId)
	this.codeMirror = CodeMirror.fromTextArea(document.getElementById(id), {
		matchBrackets: true,
		autoCloseBrackets: true,
		mode: "application/ld+json",
		lineWrapping: true,
	})
}

Editor.prototype.read = function() {
	var text = null
	try {
		text = JSON.parse(this.codeMirror.getValue())
		this.container.className = 'box default'
	} catch (e) {
		this.container.className = 'box error'
	}
	return text
}

Editor.prototype.onChange = function(fn) {
	this.codeMirror.on('change', fn)
}

const update = () => {
	var designValue = design.read()
	var contentValue = content.read()
	if (null !== designValue && null !== contentValue) {
		try {
			var html = render(contentValue, designValue)
			iframe.src = "data:text/html;charset=utf-8," + escape(html)
			preview.className = 'column box default'
		} catch (e) {
			preview.className = 'column box error'
		}
	}
}

var design = new Editor('design')
var content = new Editor('content')
var iframe = document.getElementById('result')
var preview = document.getElementById('result-container')

design.onChange(update)
content.onChange(update)

update()