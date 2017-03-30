const render = require('../src/render')
	, assert = require('assert')

describe('Render', () => {
    
    it('renders a simple block', () => {
    	const design = { text: '<p>${content}</p>' }
    	const block = { type: 'text', content: 'Hi' }
    	assert.equal('<p>Hi</p>', render(block, design))
    })
    
    it('renders a simple block with attributes', () => {
    	const design = { text: '<p class="${classes}" style="${style}">${content}</p>' }
    	const block = { type: 'text', classes: 'greet', style: 'display: inline; padding: 5px;', content: 'Hi' }
    	assert.equal('<p class="greet" style="display: inline; padding: 5px;">Hi</p>', render(block, design))
    })
    
    it('renders a complex block with one element', () => {
    	const design = {
    		text: '<p>${content}</p>',
    		rows: '<div class="rows">${content}</div>'
    	}
    	const block = {
    		type: 'rows',
    		content: { type: 'text', content: 'Hi' }
    	}
    	assert.equal('<div class="rows"><p>Hi</p></div>', render(block, design))
    })
    
    it('renders a complex block with multiple elements', () => {
    	const design = {
    		text: '<p>${content}</p>',
    		rows: '<div class="rows">${content}</div>'
    	}
    	const block = {
    		type: 'rows',
    		content: [{ type: 'text', content: 'Hello' }, { type: 'text', content: 'World' }]
    	}
    	assert.equal('<div class="rows"><p>Hello</p><p>World</p></div>', render(block, design))
    })
    
    it('renders a complex block with multiple elements and element wrapper', () => {
    	const design = {
    		text: '<p>${content}</p>',
    		rows: {layout: '<div class="rows">${content}</div>', element: '<div>${content}</div>'}
    	}
    	const block = {
    		type: 'rows',
    		content: [{ type: 'text', content: 'Hello' }, { type: 'text', content: 'World' }]
    	}
    	assert.equal('<div class="rows"><div><p>Hello</p></div><div><p>World</p></div></div>', render(block, design))
    })
    
    it('renders a complex block with multiple elements and element wrapper with attributes', () => {
        const design = {
            text: '<p>${content}</p>',
            rows: {layout: '<div class="count-${count}">${content}</div>', element: '<div class="${classes}">${content}</div>'}
        }
        const block = {
            type: 'rows',
            count: 12,
            content: [{ type: 'text', classes: 'first', content: 'Hello' }, { type: 'text', classes: 'second', content: 'World' }]
        }
        assert.equal('<div class="count-12"><div class="first"><p>Hello</p></div><div class="second"><p>World</p></div></div>', render(block, design))
    })
    
    it('renders a complex block with one element and wrapper with attributes', () => {
        const design = {
            text: '<p>${content}</p>',
            rows: {layout: '<div class="count-${count}">${content}</div>', element: '<div class="${classes}">${content}</div>'}
        }
        const block = {
            type: 'rows',
            count: 12,
            content: { type: 'text', classes: 'first', content: 'Hello' }
        }
        assert.equal('<div class="count-12"><div class="first"><p>Hello</p></div></div>', render(block, design))
    })
})