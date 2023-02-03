<?php
  $program_name = basename(__FILE__);
  $program_path = substr(strstr($_SERVER['REQUEST_URI'], $program_name, true), 1);
  $program_host = $_SERVER['HTTP_HOST'];

  $props_path = isset($_GET['q']) ? $_GET['q'] : './';
  $props_styles = isset($_GET['styles']) ? $_GET['styles'] : '';
  $props_theme = isset($_GET['theme']) ? $_GET['theme'] : 'light';

  // Cleaning the path
  // It turns ".//.husky///_" into "./.husky/_"
  $new_props_path = "";

  foreach(explode("/", $props_path) as &$path) {
    if ($path != "") {
      if ($new_props_path) $new_props_path .= "/$path";
      else $new_props_path = $path;
    }
  }

  $props_path = $new_props_path;
  unset($path);
  unset($new_props_path);
?>

<!doctype html>
<html lang='en' class='<?= $props_theme ?>'>
<head>
  <meta charset='utf-8'/>
  <meta http-equiv='x-ua-compatible' content='ie=edge'/>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'/>

  <style>
    :root.light,
    :root {
      --bg-cl: #f6f8fa;
      --err-cl: #f00;
      --scrollbar-cl: rgba(17, 88, 199, 1);
      --selection-cl: #58a6ff;

      --first-font-cl: #24292e;
      --second-font-cl: #fff;

      /* Form */
      --form-bg-cl: #fff;
      --form-border-cl: #e1e4e8;
      
      /* First button */
      --file-btn-font-cl: #24292e;
      --file-btn-bg-cl: #fafbfc;
      --file-btn-border-cl: #d9dadc;

      --file-btn-hover-font-cl: #24292e;
      --file-btn-hover-bg-cl: #f3f4f6;
      --file-btn-hover-border-cl: #d3d4d6;

      --file-btn-active-bg-cl: #edeff2;

      --file-btn-focus-font-cl: #24292e;
      --file-btn-focus-bg-cl: #f3f4f6;
      --file-btn-focus-border-cl: #d3d4d6;

      /* Second button */
      --folder-btn-font-cl: #0366d6;
      --folder-btn-bg-cl: #fafbfc;
      --folder-btn-border-cl: #d9dadc;

      --folder-btn-hover-font-cl: #fff;
      --folder-btn-hover-bg-cl: #0366d6;
      --folder-btn-hover-border-cl: #075bbb;

      --folder-btn-active-bg-cl: #035fc7;

      --folder-btn-focus-font-cl: #fff;
      --folder-btn-focus-bg-cl: #0366d6;
      --folder-btn-focus-border-cl: #075bbb;

      /* Textbox */
      --txb-bg-cl: #fafbfc;
      --txb-focus-border-cl: #0366d6;
      --txb-border-cl: #d9dadc;
      --txb-placeholder-cl: #d9dadc;
    }

    :root.dark {
      --bg-cl: #06090f;
      --scrollbar-cl: rgba(17, 88, 199, 1);
      --selection-cl: #58a6ff;

      --first-font-cl: #c9d1d9;
      --second-font-cl: #fff;

      /* Form */
      --form-bg-cl: #0d1117;
      --form-border-cl: #30363d;

      /* First button */
      --file-btn-font-cl: #c9d1d9;
      --file-btn-bg-cl: #21262d;
      --file-btn-border-cl: #30363d;
      --file-btn-hover-font-cl: #c9d1d9;
      --file-btn-hover-bg-cl: #30363d;
      --file-btn-hover-border-cl: #8b949e;
      --file-btn-active-bg-cl: #161b22;

      /* Seconds button */
      --folder-btn-font-cl: #58a6ff;
      --folder-btn-bg-cl: #21262d;
      --folder-btn-border-cl: #30363d;
      --folder-btn-hover-font-cl: #58a6ff;
      --folder-btn-hover-bg-cl: #30363d;
      --folder-btn-hover-border-cl: #58a6ff;
      --folder-btn-active-bg-cl: #0d419d;

      /* Textbox */
      --txb-bg-cl: #0d1117;
      --txb-focus-border-cl: #388bfd;
      --txb-border-cl: #21262d;
      --txb-placeholder-cl: #30363d;
    }


    ::-webkit-scrollbar {
      width: 7px;
      height: 7px;
      background-color: transparent;
    }

    ::-webkit-scrollbar-thumb {
      background-color: var(--scrollbar-cl);
    }

    ::selection {
      background-color: var(--selection-cl);
    }


    /* Global styles */
    * {
      margin: 0px;
      box-sizing: border-box;

      color: var(--first-font-cl);

      font-family:
        '-apple-system',
        'BlinkMacSystemFont',
        'Segoe UI',
        'Helvetica',
        'Arial',
        'sans-serif',
        'Apple Color Emoji',
        'Segoe UI Emoji';
    }
    
    body {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;

      min-height: 100vh;

      padding: 10px;

      background-color: var(--bg-cl);
    }

    /* Some styles for default tags */
    input[type='text'] {
      width: 60%;
      height: 26px;

      font-size: 12pt;
      color: var(--first-font-cl);
      text-align: center;

      background-color: var(--txb-bg-cl);
      border: 1px solid var(--txb-border-cl);
      border-radius: 4px;
      outline: none;
    }

    input[type='text']::-webkit-input-placeholder {
      color: var(--txb-placeholder-cl);
    }

    input[type='text']:focus {
      border: 1px solid var(--txb-focus-border-cl);
    }

    
    /* Styling components */
    button.btn-file,
    button.btn-folder {
      height: 28px;
      width: 80%;

      margin: 2px auto;
      padding: 0;

      font-size: 12pt;
      color: var(--file-btn-font-cl);
      user-select: none;
      text-align: center;

      transition: .2s cubic-bezier(.3, 0, .5, 1);
      background-color: var(--file-btn-bg-cl);
      border: 1px solid var(--file-btn-border-cl);
      border-radius: 4px;
      outline: none;
    }


    button.btn-file:hover {
      color: var(--file-btn-hover-font-cl);

      background-color: var(--file-btn-hover-bg-cl);
      border: 1px solid var(--file-btn-hover-border-cl);
    }

    button.btn-file:active {
      background-color: var(--file-btn-active-bg-cl);
    }

    button.btn-file:focus {
      color: var(--file-btn-focus-font-cl);

      border: 1px solid var(--file-btn-focus-border-cl);
      background-color: var(--file-btn-focus-bg-cl);
    }

    button.btn-folder {
      color: var(--folder-btn-font-cl);

      background-color: var(--folder-btn-bg-cl);
      border: 1px solid var(--folder-btn-border-cl);
    }

    button.btn-folder:hover {
      color: var(--folder-btn-hover-font-cl);

      border: 1px solid var(--folder-btn-hover-border-cl);
      background-color: var(--folder-btn-hover-bg-cl);
    }

    button.btn-folder:active {
      background-color: var(--folder-btn-active-bg-cl);
      color: var(--folder-btn-hover-font-cl);
    }

    button.btn-folder:focus {
      color: var(--folder-btn-focus-font-cl);

      border: 1px solid var(--folder-btn-focus-border-cl);
      background-color: var(--folder-btn-focus-bg-cl);
    }

    button.btn-folder a,
    button.btn-file a {
      display: grid;
      place-items: center;

      height: 100%;
      width: 100%;

      user-select: none;
      text-decoration: none;
    }

    button.btn-file.hidden,
    button.btn-folder.hidden {
      display: none;
    }

    svg.btn {
      width: 20px;
      height: 20px;

      margin: 6px;

      transition: fill .5s;
      fill: var(--first-font-cl);

      cursor: pointer;
    }

    svg.btn.red {
      fill: var(--err-cl);
    }

    /* Styling page */
    #contents {
      display: flex;
      flex-direction: column;
      gap: 20px;

      width: 90%;

      min-height: 340px;
      max-width: 500px;

      margin: 50px 0 10px 0;
      padding: 4px;
      padding-bottom: 6px;

      color: var(--first-font-cl);
      text-align: center;

      background-color: var(--form-bg-cl);
      border-radius: 6px;
      border: 1px solid var(--form-border-cl);
    }

    #header {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    #header #title {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;

      width: 100%;
    }

    #header #title h1 {
      font-size: 18pt;
      user-select: none;

      margin: 0px;
      margin-bottom: 6px;
    }

    #browser {
      flex-grow: 1;

      width: 100%;

      margin: 6px auto 20px auto;

      background-color: #fff;
      border: 1px solid var(--form-border-color);
      border-radius: 6px;
    }

    #browser-header {
      display: flex;
      justify-content: start;

      width: 100%;
    }

  </style>

  <?php
    if ($props_styles)
      ?>
        <link rel='stylesheet' href='<?= $props_styles ?>'/>
      <?php
  ?>

  <link rel='icon' href='https://icons.iconarchive.com/icons/papirus-team/papirus-mimetypes/256/app-x-php-icon.png'/>
  <title>&#60;/&#62; File list on server</title>
</head>
<body>

  <?php if (is_dir($props_path)): ?>
    <main id='contents'>
      <header id='header'>
        <div id='title'>
          <svg id='btn-go-back' class='btn' viewBox='0 0 512 512'>
            <path d='M492,236H68.442l70.164-69.824c7.829-7.792,7.859-20.455,0.067-28.284c-7.792-7.83-20.456-7.859-28.285-0.068l-104.504,104c-0.007,0.006-0.012,0.013-0.018,0.019c-7.809,7.792-7.834,20.496-0.002,28.314c0.007,0.006,0.012,0.013,0.018,0.019l104.504,104c7.828,7.79,20.492,7.763,28.285-0.068c7.792-7.829,7.762-20.492-0.067-28.284L68.442,276H492c11.046,0,20-8.954,20-20C512,244.954,503.046,236,492,236z'/>
          </svg>

          <h1>File list on server</h1>

          <svg id='btn-reload' class='btn' viewBox='0 0 458.186 458.186'>
            <g transform='matrix(-1,0,0,1,458.1860580444336,0)'>
              <path d='M445.651,201.95c-1.485-9.308-10.235-15.649-19.543-14.164c-9.308,1.485-15.649,10.235-14.164,19.543c0.016,0.102,0.033,0.203,0.051,0.304c17.38,102.311-51.47,199.339-153.781,216.719c-102.311,17.38-199.339-51.47-216.719-153.781S92.966,71.232,195.276,53.852c62.919-10.688,126.962,11.29,170.059,58.361l-75.605,25.19c-8.944,2.976-13.781,12.638-10.806,21.582c0.001,0.002,0.002,0.005,0.003,0.007c2.976,8.944,12.638,13.781,21.582,10.806c0.003-0.001,0.005-0.002,0.007-0.002l102.4-34.133c6.972-2.322,11.675-8.847,11.674-16.196v-102.4C414.59,7.641,406.949,0,397.523,0s-17.067,7.641-17.067,17.067v62.344C292.564-4.185,153.545-0.702,69.949,87.19s-80.114,226.911,7.779,310.508s226.911,80.114,310.508-7.779C435.905,339.799,457.179,270.152,445.651,201.95z'/>
            </g>
          </svg>
        </div>

        <input type='text' id='txb-search' placeholder='Search files and folders'/>
      </header>

      <main>
        <?php
          $dir = dir($props_path);
          $url_suffix = "";

          if ($props_styles) $url_suffix .= "&styles=$props_styles";
          if ($props_theme) $url_suffix .= "&theme=$props_theme";

          // Listing directories

          while(($name = $dir -> read()) != false) {
            if (!in_array($name, array('.', '..')) and is_dir("$props_path/$name"))
            {
              $id = strtolower(str_replace(' ', '-', $name));
              $url = "//$program_host/$program_path$program_name?q=$props_path/$name$url_suffix";

              ?>
                <button id='folder:<?= $id ?>' class='item btn-folder'>
                  <a href='<?= $url ?>'><?= $name ?></a>
                </butt>
              <?php
            }
          }

          // Listing files

          $dir -> close();
          $dir = dir($props_path);

          while(($name = $dir -> read()) != false)
          {
            if (!in_array($name, array('.', '..')) and is_file("$props_path/$name"))
            {
              $id = strtolower(str_replace(' ', '-', $name));
              $url = "//$program_host/$program_path$program_name?q=$props_path/$name$url_suffix";

              ?>
                <button id='file:<?= $id ?>' class='item btn-file'>
                  <a href='<?= $url ?>'><?= $name ?></a>
                </button>
              <?php
            }
          }

          $dir -> close();
        ?>
      </main>
    </main>
  <?php endif; ?>

  <?php if (is_file($props_path)): ?>
    <header id='browser-header'>
      <svg id='btn-go-back' class='btn' viewBox='0 0 512 512'>
        <path d='M492,236H68.442l70.164-69.824c7.829-7.792,7.859-20.455,0.067-28.284c-7.792-7.83-20.456-7.859-28.285-0.068l-104.504,104c-0.007,0.006-0.012,0.013-0.018,0.019c-7.809,7.792-7.834,20.496-0.002,28.314c0.007,0.006,0.012,0.013,0.018,0.019l104.504,104c7.828,7.79,20.492,7.763,28.285-0.068c7.792-7.829,7.762-20.492-0.067-28.284L68.442,276H492c11.046,0,20-8.954,20-20C512,244.954,503.046,236,492,236z'/>
      </svg>

      <svg id='btn-reload' class='btn' viewBox='0 0 458.186 458.186'>
        <g transform='matrix(-1,0,0,1,458.1860580444336,0)'>
          <path d='M445.651,201.95c-1.485-9.308-10.235-15.649-19.543-14.164c-9.308,1.485-15.649,10.235-14.164,19.543c0.016,0.102,0.033,0.203,0.051,0.304c17.38,102.311-51.47,199.339-153.781,216.719c-102.311,17.38-199.339-51.47-216.719-153.781S92.966,71.232,195.276,53.852c62.919-10.688,126.962,11.29,170.059,58.361l-75.605,25.19c-8.944,2.976-13.781,12.638-10.806,21.582c0.001,0.002,0.002,0.005,0.003,0.007c2.976,8.944,12.638,13.781,21.582,10.806c0.003-0.001,0.005-0.002,0.007-0.002l102.4-34.133c6.972-2.322,11.675-8.847,11.674-16.196v-102.4C414.59,7.641,406.949,0,397.523,0s-17.067,7.641-17.067,17.067v62.344C292.564-4.185,153.545-0.702,69.949,87.19s-80.114,226.911,7.779,310.508s226.911,80.114,310.508-7.779C435.905,339.799,457.179,270.152,445.651,201.95z'/>
        </g>
      </svg>
    </header>

    <iframe id='browser' src='<?= $props_path ?>' frameborder='0'></iframe>
  <?php endif; ?>

  <script>
    const $btnReload = document.querySelector('#btn-reload')
    const $btnGoBack = document.querySelector('#btn-go-back')
    const $txbSearch = document.querySelector('#txb-search')
    const $itemS = document.querySelectorAll('.item')

    $btnReload.addEventListener('click', window.location.reload)
    $btnGoBack.addEventListener('click', () => {
      const propsPath = '<?= $props_path ?>'.split('/')
      propsPath.pop()

      const path = propsPath.join('/')

      if (path) {
        const url = `<?= "//$program_host/$program_path$program_name?q=" ?>${path}<?= "$url_suffix" ?>`

        window.location = url
      }
      else {
        $btnGoBack.classList.add('red')
        
        setTimeout(() => {
          $btnGoBack.classList.remove('red')
        }, 600)
      }
    })

    $txbSearch.addEventListener('keyup', ev => {
      const text = ev.target.value

      for (const item of $itemS) {
        if (item.innerText.includes(text))
          item.classList.remove('hidden')
        else
          item.classList.add('hidden')
      }
    })
  </script>
</body>
</html>