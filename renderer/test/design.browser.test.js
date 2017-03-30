const browser = require('../src/design/browser')
    , render  = require('../src/render')
    , assert  = require('assert') 

describe('Browser', () => {
  
  describe('Single blocks', () => {
      
    it('email', () => {
      const block = { type: 'email', title: 'Testing', content: 'Hello World' }
      assert.equal('<!doctype html><html><head><title>Testing</title><meta charset="utf-8"><style>div,p{text-align:center} .columns{display:flex} img{display:inline-block}</style></head><body>Hello World</body></html>', render(block, browser))
    })

    it('rows', () => {
      const block = { type: 'rows', content: 'Hello World' }
      assert.equal('<div>Hello World</div>', render(block, browser))
    })

    it('columns', () => {
      const block = { type: 'columns', content: 'Hello World' }
      assert.equal('<div class="columns">Hello World</div>', render(block, browser))
    })

    it('text', () => {
      const block = { type: 'text', content: 'Hello World' }
      assert.equal('<p>Hello World</p>', render(block, browser))
    })

    it('image', () => {
      const block = { type: 'image', src: 'http://placehold.it/200x150', alt: 'Sample', width: 200, height: 150 }
      assert.equal('<img src="http://placehold.it/200x150" alt="Sample" width="200" height="150"/>', render(block, browser))
    })

  })

  describe('Layouts', () => {

    it('two rows', () => {
      const block = { 
        type: 'rows', 
        content: [
          {type: 'text', content: 'Hello'},
          {type: 'text', content: 'World'}
        ]
      }
      assert.equal('<div><div><p>Hello</p></div><div><p>World</p></div></div>', render(block, browser))
    })

    it('two columns', () => {
      const block = { 
        type: 'columns', 
        content: [
          {type: 'text', content: 'Hello', size: 1},
          {type: 'text', content: 'World', size: 1}
        ]
      }
      assert.equal('<div class="columns"><div style="flex:1"><p>Hello</p></div><div style="flex:1"><p>World</p></div></div>', render(block, browser))
    })

    it('menu (with 5 items), sidebar, content (twice the width of sidebar) and footer', () => {
      const block = {
        type: 'email',
        title: 'Full Layout',
        content: {
          type: 'rows',
          content: [{
            type: 'columns',
            content:[
              {type: 'text', size: 1, content: 'Item 1'},
              {type: 'text', size: 1, content: 'Item 2'},
              {type: 'text', size: 1, content: 'Item 3'},
              {type: 'text', size: 1, content: 'Item 4'},
              {type: 'text', size: 1, content: 'Item 5'}
            ]
          },{
            type: 'columns',
            content: [
              {type: 'text', size: 1, content: 'The sidebar here ...'},
              {type: 'text', size: 2, content: 'The content here ...'}
            ]
          },{
            type: 'text', content: 'footer'
          }]
        }
      }
      assert.equal('<!doctype html><html><head><title>Full Layout</title><meta charset="utf-8"><style>div,p{text-align:center} .columns{display:flex} img{display:inline-block}</style></head><body><div><div><div class="columns"><div style="flex:1"><p>Item 1</p></div><div style="flex:1"><p>Item 2</p></div><div style="flex:1"><p>Item 3</p></div><div style="flex:1"><p>Item 4</p></div><div style="flex:1"><p>Item 5</p></div></div></div><div><div class="columns"><div style="flex:1"><p>The sidebar here ...</p></div><div style="flex:2"><p>The content here ...</p></div></div></div><div><p>footer</p></div></div></body></html>', render(block, browser))
    })
  })
})