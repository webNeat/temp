# 3. Newsletter Renderer

## The code step by step

As you can see, the `src` directory contains only 2 files with a sum of 130 line of code, so let's write it step by step.

Let's start by looking at the simple blocks `text` and `image` and writing simple templates for them:

```javascript
const text  = '<p>${content}</p>'
const image = '<img src="${src}" alt="${alt}" width="${width}" height="${height}"/>'
```

Note that we are using the syntax `${name}` for variable parts of the template. These parts will be filled from the JSON structure of each block. So a `text` JSON structure needs to have an attribute `content`; and an `image` needs to have `src`, `alt`, `width` and `height`.

Now we need a function that takes a template and fills it using a simple object:
```javascript
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

// Examples
fill('<p>${content}</p>', {content: 'Hello World'}) 
    //=> '<p>Hello World</p>'
fill('<div class="${classes}">${text}</div>', {
    classes: 'alert alert-success',
    text: 'Yeah !'
}) //=> <div class="alert alert-success">Yeah</div>
```

Now let's collect the templates in one variable:

```javascript
const templates = {
    text: '<p>${content}</p>',
    image: '<img src="${src}" alt="${alt}" width="${width}" height="${height}"/>'
}
```

And then write the function `render` which takes a block and return the corresponding HTML. A block will always have an attribute `type` that's used to retreive its template.

```javascript
const render = block => {
    return fill(templates[block.type], block)
}
```

Yes, we need to check if `block.type` exists in `templates` but we will do that later. Let's see how to render complex layouts first.

Looking at the example layouts, we see that all of them can be made by grouping elements in `rows` and `columns`. Let's starting by grouping elements in rows:

```html
<div class="container">
    <div class="row">Element 1</div>
    <div class="row">Element 2</div>
    <div class="row">Element 3</div>
</div>
```

So in order to render a group of rows, we need to render each element, put it inside a `div.row` then insert all inside a container `div.container`. Let's define the following template:

```javascript
templates.rows = {
    element: '<div class="row">${content}</div>',
    layout: '<div class="container">${content}</div>'
}
```

It contains two parts, the `element` part which will be applied to each element then the concatenation of all results will be passed to fill the `layout` part.

Let's define a block of type `rows`:
```javascript
var block = {
    type: 'rows',
    content: [
        {type: 'text', content: 'Row 1'},
        {type: 'text', content: 'Row 2'}
    ]
}
```

Note that the `content` of a block `rows` is an array of blocks.

All we need to do now is to update the `render` function so that it can render this new type of blocks, and add the `columns` template the same way.

Finally, we need to add the global block representing the whole HTML document called `email`.

The file `src/render.js` contains the final code of `render` function.
The file `src/design/broswer.js` contains the templates to generate the HTML for a modern browser.

## Features

- Mutiple designs (like `browser.js`) can be defined and switched easily (the design is actually a parameter of `render`).

- Design can be also sent as JSON !

- New blocks can be added very easily.

- Not limited to Newsletters or HTML documents. Can be used to generate any kind of markup (or even more).

- You can define and try designs in real time using the **Live Editor**

## Tests

Tests are under the `test` directory. you can run them using `npm test`.

## Live Editor

A single web page `live/index.html` which can be opened directly in your browser (no need for any webserver). It provides two editors to write the design description and content description as JSON and renders the resulting HTML on every change giving you the possibility to test and debug easily.

- The editors become red when there is a JSON syntax error.

- The preview border is red if an error occured during the `render` function.

## Notes

- I used some features of ES6 while writting the code since most of modern browsers supports them.

- The live editor was also written in plain javascript/css (apart from the usage of `codemirror` for syntax highlighting).

- Didn't add other types of blocks or other design but you see that it's really easy to do so.
