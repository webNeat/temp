/**
 * Simple modern browser design description.
 * Defines the following blocks:
 * - email: {title, content}
 * 	 represents the whole HTML document
 * - rows: {content}
 *   represents a vertical group of blocks
 * - columns: {content}
 *   represents an horizontal group of blocks, each block should have
 *   the attribute `size` which is the width factor for that element
 * - text: {content}
 *   represents a paragraph
 * - image: {src, alt, width, height}
 *   represents an image
 *
 * @type {Object}
 */
const browser = {
	email: '<!doctype html><html><head><title>${title}</title><meta charset="utf-8"><style>div,p{text-align:center} .columns{display:flex} img{display:inline-block}</style></head><body>${content}</body></html>',
	rows: {
		layout: '<div>${content}</div>',
		element: '<div>${content}</div>'
	},
	columns: {
		layout: '<div class="columns">${content}</div>',
		element: '<div style="flex:${size}">${content}</div>'
	},
	text: '<p>${content}</p>',
	image: '<img src="${src}" alt="${alt}" width="${width}" height="${height}"/>'
}

module.exports = browser