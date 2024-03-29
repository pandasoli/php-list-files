<div align='center'>

# List all PHP files

I was tired of having to select one file after another while doing<br/>
my PHP classes so I created this project.

Please, don't read the code of old versions I was learning English that time.

<br/>

## It can receive these props:
</div>

- `q` expects a path to a folder or a file
- `styles` expects a path to a css file
- `theme` expects a theme name

<br/>
<div align='center'>

## Themes
Its format is like this:

</div>

```css
  :root.orange {
    --bg-cl: orange;
    --err-cl: orange;
    --scrollbar-cl: orange;

    --file-btn-hover-border-cl: #f39c12;

    --folder-btn-font-cl: orange;
    --folder-btn-hover-bg-cl: orange;
    --folder-btn-hover-border-cl: #f39c12;
    --folder-btn-active-bg-cl: #f39c12;
  }
```
<div align='center'>

There are two built-in themes, `light` and` dark`, with `light` being the default.  
If you are interested here's all the variables that you can change:

</div>

<details>
  <summary>Variables</summary>

  `--bg-cl` the main background  
  `--err-cl` a color for errors  
  `--scrollbar-cl`
  `--selection-cl` text selection color

  `--first-font-cl`  
  `--second-font-cl`

  <div align='center'>

  ### Form
  </div>

  `--form-bg-cl` the form background  
  `--form-border-cl`

  <div align='center'>

  ### File button
  </div>

  `--file-btn-font-cl`  
  `--file-btn-bg-cl`  
  `--file-btn-border-cl`

  `--file-btn-hover-font-cl`  
  `--file-btn-hover-bg-cl`  
  `--file-btn-hover-border-cl`

  `--file-btn-active-bg-cl`

  `--file-btn-focus-font-cl`  
  `--file-btn-focus-bg-cl`  
  `--file-btn-focus-border-cl`

  <div align='center'>

  ### Folder button
  </div>

  `--folder-btn-font-cl`  
  `--folder-btn-bg-cl`  
  `--folder-btn-border-cl`

  `--folder-btn-hover-font-cl`  
  `--folder-btn-hover-bg-cl`  
  `--folder-btn-hover-border-cl`

  `--folder-btn-active-bg-cl`

  `--folder-btn-focus-font-cl`  
  `--folder-btn-focus-bg-cl`  
  `--folder-btn-focus-border-cl`

  <div align='center'>

  ### Textbox
  </div>

  `--txb-bg-cl`  
  `--txb-focus-border-cl`  
  `--txb-border-cl`  
  `--txb-placeholder-cl`

  <div align='center'>
    If you made a nice theme, pleaseeee make a pull request and I'll add it built-in.
  </div>
</details>

<br/>
<div align='center'>

## Dev notes
In this repo I used a `Node.js` package to force myself to use [Conventional Commits](https://conventionalcommits.org).  
To start the environment run:

</div>

```bash
npm i
```

<div align='center'>
I'm not sure, but maybe you also have to run:
</div>

```bash
npx husky install
```
