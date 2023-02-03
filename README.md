<div align='center'>

# List all files in PHP server
Jump between folders and files faster 😇🐘  
It has a look inspired by GitHub.

> I was tired of having to select one file after another while  
taking my PHP classes so I created that.  
Please, do not see the code of the old versions -.- I was still learning.  
My English was sooo bad that time 🤭

<br/>

The main file is the `index.php`.

<br/>

## It can receive these props:
</div>

- `q` this expects a path to a folder or a file;
- `styles` this expects a path to a css file;
- `theme` this expects a theme name.

<br/>
<div align='center'>

## Themes
`Themes` are styles that change everything in the user interface.  
They are inside the css file you pass.

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
In this repo I used a `Node.js` package to force me to use [Conventional Commits](https://conventionalcommits.org).  
To start the environment run:

</div>

```bash
  pnpm i
  # or
  npm i
  # or
  yarn
```
<div align='center'>
And maybe you also have to run:
</div>

```bash
  npx husky install
```
<div align='center'>
But I'm not sure.
</div>
