/**
 * Renders a `block` using a `design` and an optional `wrapper`.
 *
 * @param  {Object} block
 * @param  {Object} design
 * @param  {String} wrapper
 * @return {String}
 */
const render = (block, design, wrapper) => {
	const type = block.type
	var template = design[type],
		result = ''
	if (undefined === template) {
		const templates = Object.keys(design).join(', ')
		throw `Cannot find the template for type '${type}'. Available templates are '${templates}'`
	}

	var content = block.content
	if (undefined !== content && typeof content != 'string') {
		// This block have a complex content
		// Let's see if there are multiple elements inside
		if (Array === content.constructor) {
			// Let's render all the element and wrap them with template.element if any
			content = content
				.map(element => render(element, design, template.element))
				.join('')
		} else {
			// Let's render the element inside
			content = render(content, design, template.element)
		}
	}

	if (typeof template != 'string')
		// if this is a layout template, let's use it
		template = template.layout

	result = fill(template, merge(block, {content}))
	if (wrapper !== undefined)
		result = fill(wrapper, merge(block, {content: result}))

	return result
}

/**
 * Fills a template with some data; by replacing `${key}`
 * with the value of `data[key]` for each key of data.
 *
 * @param  {String} tpl
 * @param  {Object} data
 * @return {String}
 */
const fill = (tpl, data) => {
	/**
	 * Fills the field `name`
	 * @param  {String} name
	 * @param  {String} text
	 * @return {String}
	 */
	const fillField = (text, name) =>
		replaceAll(text, '${' + name + '}', data[name])

	return Object.keys(data).reduce(fillField, tpl)
}

/**
 * Replaces all occurences of `search` in `text` with `replacement`.
 *
 * @param  {String} text
 * @param  {String} search
 * @param  {String} replacement
 * @return {String}
 */
const replaceAll = (text, search, replacement) => {
	// Escapping all regular experssion characters in the `search` string
	search = search.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')
	return text.replace(new RegExp(search, 'g'), replacement)
}

/**
 * Returns a copy of `objA` after adding the attributes
 * of `objB` to it. Note that if the two objects have a
 * same key, the second value is taken.
 *
 * @param  {Object} objA
 * @param  {Object} objB
 * @return {Object}
 */
const merge = (objA, objB) => {
	var result = {}
	for (key in objA)
		result[key] = objA[key]
	for (key in objB)
		result[key] = objB[key]
	return result
}

module.exports = render