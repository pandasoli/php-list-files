<!doctype html>
<html lang='en'>
<head>
    <meta charset='utf-8'/>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
    <?php
        $program_name = basename(__FILE__);
        $program_local = substr(strstr($_SERVER['REQUEST_URI'], $program_name, true), 1);
        $theme = isset( $_GET['theme'] ) ? $_GET['theme'] : 'light';
        $dir = isset( $_GET['search'] ) ? $_GET['search'] : './';
        $browse = isset( $_GET['browse'] ) ? $_GET['browse']  : false;
        $removeExtension = isset( $_GET['removeex'] ) ? $_GET['removeex'] : false;
        $delete = isset( $_GET['delete'] ) ? $_GET['delete'] : false;
        $create = isset( $_GET['create'] ) ? $_GET['create'] : false;
        $content = isset( $_GET['content'] ) ? $_GET['content'] : false;
        $newStyleSheet = isset( $_GET['styles'] ) ? $_GET['styles'] : false;
        $tmp01 = '';
        $tmp02 = '';

        echo "
            <script>
                const theme                    = '$theme'
                const program_name             = '$program_name'
                const dir                      = '$dir'
                let file_list                  = []
                let delete_file_list           = []
                let deleted_files              = []
                let deleted_files_number_lines = []
                let folder_list                = []
                let file_lines                 = []
                let _tmp                        = document.querySelector('html')
                let _tmpBool                    = false
                _tmp.className += theme
            </script>
        ";
    ?>

    <style>

        :root {
            --background-color: #f6f8fa;
            --scrollbar-thumb-background-color: rgba(17, 88, 199, 1);
            --selection-background-color: #58a6ff;

            --btn-focus-box-shadow: 0px 0px 0px 3px rgba(17, 88, 199, .4);

            --txb-background-color: #fafbfc;
            --txb-focus-border-color: #0366d6;
            --txb-border-color: #d9dadc;
            --txb-placeholder-color: #d9dadc;

            --first-btn-font-color: #24292e;
            --first-btn-background-color: #fafbfc;
            --first-btn-border-color: #d9dadc;
            --first-btn-hover-font-color: #24292e;
            --first-btn-hover-background-color: #f3f4f6;
            --first-btn-hover-border-color: #d3d4d6;
            --first-btn-active-background-color: #edeff2;

            --second-btn-font-color: #0366d6;
            --second-btn-background-color: #fafbfc;
            --second-btn-border-color: #d9dadc;
            --second-btn-hover-font-color: #fff;
            --second-btn-hover-background-color: #0366d6;
            --second-btn-hover-border-color: #075bbb;
            --second-btn-active-background-color: #035fc7;

            --error-message-fill: #d9dadc;

            --first-font-color: #24292e;
            --second-font-color: #fff;
            --form-background-color: #fff;
            --form-border-color: #e1e4e8;
        }

        :root.darkness {
            --background-color: #06090f;
            --scrollbar-thumb-background-color: rgba(17, 88, 199, 1);
            --selection-background-color: #58a6ff;

            --btn-focus-box-shadow: 0px 0px 0px 3px rgba(17, 88, 199, .4);

            --txb-background-color: #0d1117;
            --txb-focus-border-color: #388bfd;
            --txb-border-color: #21262d;
            --txb-placeholder-color: #30363d;

            --first-btn-font-color: #c9d1d9;
            --first-btn-background-color: #21262d;
            --first-btn-border-color: #30363d;
            --first-btn-hover-font-color: #c9d1d9;
            --first-btn-hover-background-color: #30363d;
            --first-btn-hover-border-color: #8b949e;
            --first-btn-active-background-color: #161b22;

            --second-btn-font-color: #58a6ff;
            --second-btn-background-color: #21262d;
            --second-btn-border-color: #30363d;
            --second-btn-hover-font-color: #58a6ff;
            --second-btn-hover-background-color: #30363d;
            --second-btn-hover-border-color: #58a6ff;
            --second-btn-active-background-color: #0d419d;

            --error-message-fill: #21262d;

            --first-font-color: #c9d1d9;
            --second-font-color: #fff;
            --form-background-color: #0d1117;
            --form-border-color: #30363d;
        }

        ::-webkit-scrollbar {
            width: 7px;
            height: 7px;
            background-color: var(--background-color);
        }
        ::-webkit-scrollbar-thumb {
            background-color: var(--scrollbar-thumb-background-color);
        }

        ::selection {
            background-color: var(--selection-background-color);
        }

        body {
            margin: 0px;
            background-color: var(--background-color);
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

        /* Initial */
        body div#initial,
        body div#info-item {
            max-width: 500px;
            width: 90%;
            height: auto;
            min-height: 340px;
            display: block;
            position: relative;
            margin: 50px auto 10px auto;
            background-color: var(--form-background-color);
            color: var(--first-font-color);
            text-align: center;
            border-radius: 6px;
            padding: 4px;
            padding-bottom: 6px;
            border: 1px solid var(--form-border-color);
        }

        /* header */
        body div#initial div#header {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        body div#initial div#header div#title {
            display: flex;
            flex-wrap: wrap;
            width: 100%;
            justify-content: space-between;
        }

        body div#initial div#header div#title h1 {
            font-size: 18pt;
            margin: 0px;
            margin-bottom: 6px;
            width: auto;
            display: inline-block;
        }

        body div#initial div#header div#title svg.top-buttons {
            width: 20px;
            height: 20px;
            border: none;
            background-color: transparent;
            border-radius: 0px;
            display: inline-block;
            position: relative;
            fill: var(--first-font-color);
            margin: 6px;
        }

        body div#initial div#header input#txbSearch {
            border: 1px solid var(--txb-border-color);
            border-radius: 4px;
            width: 60%;
            height: 20px;
            background-color: var(--txb-background-color);
            outline: none;
            color: var(--first-font-color);
            text-align: center;
            font-size: 12pt;
            display: inline-block;
        }
        body div#initial div#header input#txbSearch::-webkit-input-placeholder {
            color: var(--txb-placeholder-color);
        }
        body div#initial div#header input#txbSearch:focus {
            border: 1px solid var(--txb-focus-border-color);
        }

        /* Buttons */
        body div#initial div#buttons {
            padding-top: 8px;
        }

        body div#initial div#buttons div.btn-division a.item {
            text-decoration: none;
            outline: none;
            transition: .2s cubic-bezier(.3, 0, .5, 1);
                -webkit-transition: .2s cubic-bezier(.3, 0, .5, 1);
                -moz-transition: .2s cubic-bezier(.3, 0, .5, 1);
                -o-transition: .2s cubic-bezier(.3, 0, .5, 1);
            user-select: none;
                -webkit-user-select: none;
                -moz-user-select: none;
                -moz-user-select: none;
            display: block;
            width: 80%;
            text-align: center;
            margin: 6px auto 6px auto;
            font-size: 12pt;
            border-radius: 4px;
            height: 24px;
            color: var(--first-btn-font-color);
            background-color: var(--first-btn-background-color);
            border: 1px solid var(--first-btn-border-color);
        }
        body div#initial div#buttons div.btn-division a.item:hover {
            color: var(--first-btn-hover-font-color);
            background-color: var(--first-btn-hover-background-color);
            border: 1px solid var(--first-btn-hover-border-color);
        }
        body div#initial div#buttons div.btn-division a.item:hover ~ svg {
            display: inline-block;
        }
        body div#initial div#buttons div.btn-division a.item:active {
            background-color: var(--first-btn-active-background-color);
        }
        body div#initial div#buttons div.btn-division a.item:focus {
            box-shadow: var(--btn-focus-box-shadow);
            border: 1px solid var(--first-btn-hover-border-color);
            color: var(--first-btn-hover-font-color);
            background-color: var(--first-btn-hover-background-color);
        }
        body div#initial div#buttons div.btn-division {
            position: relative;
        }
        body div#initial div#buttons div.btn-division svg {
            width: 16px;
            top: 5px;
            margin-left: 36%;
            cursor: pointer;
            position: absolute;
            fill: var(--first-font-color);
            display: none;
        }
        body div#initial div#buttons div.btn-division svg:hover,
        body div#initial div#buttons div.btn-division svg:hover ~ svg {
            display: inline-block;
        }

        body div#initial div#buttons div.btn-division a.item.btn-folder {
            color: var(--second-btn-font-color);
            background-color: var(--second-btn-background-color);
            border: 1px solid var(--second-btn-border-color);
        }
        body div#initial div#buttons div.btn-division a.item.btn-folder:hover {
            color: var(--second-btn-hover-font-color);
            border: 1px solid var(--second-btn-hover-border-color);
            background-color: var(--second-btn-hover-background-color);
        }
        body div#initial div#buttons div.btn-division a.item.btn-folder:active {
            background-color: var(--second-btn-active-background-color) !important;
            color: var(--second-btn-hover-font-color);
        }
        body div#initial div#buttons div.btn-division a.item.btn-folder:focus {
            color: var(--second-btn-hover-font-color);
            border: 1px solid var(--second-btn-hover-border-color);
            background-color: var(--second-btn-hover-background-color);
            
        }

        body div#initial div#buttons div.btn-division a.deleted-item,
        body div#initial div#buttons div.btn-division svg.deleted-item {
            display: none !important;
        }

        /* Error */
        body div#initial div#error {
            display: none;
            margin-top: 50px;
        }

        body div#initial div#error svg {
            fill: var(--error-message-fill);
            width: 100px;
        }

        body div#initial div#error h2 {
            color: var(--error-message-fill);
            font-size: 14pt;
            margin: 0px;
        }

        /* Iframe delete files */
        body iframe#iframe-file-functions {
            display: none;
        }

        /* Popup recreate deleted file */
        body div#popup-recreate-file {
            position: relative;
            transition: all 3s ease-in;
            display: none;
            margin: 6px;
        }

        body div#popup-recreate-file div.content {
            cursor: pointer;
            border-radius: 6px;
            color: var(--first-font-color);
            background-color: var(--form-background-color);
            border: 1px solid var(--form-border-color);
            align-items: center;
            display: flex;
            padding-left: 20px;
            width: 300px;
            height: 30px;
        }

        body div#popup-recreate-file div p {
            margin: 0px;
        }

        /* Browser */
        body div#buttons {
            padding: 4px 0px 4px 0px;
        }

        body div#buttons svg.btnBrowser {
            fill: var(--first-font-color);
            height: 24px;
            margin-left: 10px;
        }

        body div#buttons svg.btnBrowser.btnReload {
            height: 20px;
        }

        body iframe#browser {
            width: 90%;
            height: 90vh;
            margin: 6px auto 20px auto;
            display: block;
            position: relative;
            border: 1px solid var(--form-border-color);
            border-radius: 6px;
            background-color: #fff;
        }

        @media (max-width: 790px) {
            body div#popup-recreate-file {
                justify-content: center;
            }

            body div#popup-recreate-file div.content p {
                width: 90%;
                text-align: center;
            }
        }

    </style>

    <?php
        if ($newStyleSheet) {
            echo "<link rel='stylesheet' href='$newStyleSheet'/>";
        }
    ?>

    <link rel='icon' href='https://icons.iconarchive.com/icons/papirus-team/papirus-mimetypes/256/app-x-php-icon.png'/>
    <title>&#60;/&#62; File list on server</title>
</head>
<body>

    <?php
        if ($browse != false) {
            goto createBrowser;
        }

        if ($delete != false and file_exists($delete)) {
            // unlink($delete);
            goto end_program;
        }

        if ($create != false) {
            echo $create. '=>'. str_replace('$this<-|->break-line', "\n", $content);
            // $file = fopen($create, 'w');
            // fwrite($file, $content);
            // fclose($file);
            goto end_program;
        }

    ?>

    <div id='initial'>

        <div id='header'>
            <div id='title'>
                <svg class='top-buttons' onclick='javascript:history.go(-1)' viewBox='0 0 512 512'> <path d='M492,236H68.442l70.164-69.824c7.829-7.792,7.859-20.455,0.067-28.284c-7.792-7.83-20.456-7.859-28.285-0.068l-104.504,104c-0.007,0.006-0.012,0.013-0.018,0.019c-7.809,7.792-7.834,20.496-0.002,28.314c0.007,0.006,0.012,0.013,0.018,0.019l104.504,104c7.828,7.79,20.492,7.763,28.285-0.068c7.792-7.829,7.762-20.492-0.067-28.284L68.442,276H492c11.046,0,20-8.954,20-20C512,244.954,503.046,236,492,236z'/> </svg>
                <h1>File list on server</h1>
                <svg class='top-buttons' onclick='window.location.reload()' viewBox='0 0 458.186 458.186'> <g transform='matrix(-1,0,0,1,458.1860580444336,0)'> <path d='M445.651,201.95c-1.485-9.308-10.235-15.649-19.543-14.164c-9.308,1.485-15.649,10.235-14.164,19.543c0.016,0.102,0.033,0.203,0.051,0.304c17.38,102.311-51.47,199.339-153.781,216.719c-102.311,17.38-199.339-51.47-216.719-153.781S92.966,71.232,195.276,53.852c62.919-10.688,126.962,11.29,170.059,58.361l-75.605,25.19c-8.944,2.976-13.781,12.638-10.806,21.582c0.001,0.002,0.002,0.005,0.003,0.007c2.976,8.944,12.638,13.781,21.582,10.806c0.003-0.001,0.005-0.002,0.007-0.002l102.4-34.133c6.972-2.322,11.675-8.847,11.674-16.196v-102.4C414.59,7.641,406.949,0,397.523,0s-17.067,7.641-17.067,17.067v62.344C292.564-4.185,153.545-0.702,69.949,87.19s-80.114,226.911,7.779,310.508s226.911,80.114,310.508-7.779C435.905,339.799,457.179,270.152,445.651,201.95z'/> </svg>
            </div>

            <input type='text' id='txbSearch' placeholder='Search files and folders'/>
        </div>

        <div id='buttons'>

            <?php

                if (is_dir($dir)) {

                    $directory = dir($dir);
                    while(($folder = $directory -> read()) != false)
                    {
                        if ( $folder != '.' and $folder != '..' and is_dir($dir. '/'. $folder) )
                        {
                            $tmp01 = strtolower(str_replace(' ', '-', $folder));
                            $url = "http://localhost:8080/$program_local$program_name?search=$dir/$folder&theme=$theme";

                            echo "
                            <div class='btn-division'>
                                <a href='$url' class='item $tmp01 btn-folder'>$folder</a>
                            </div>";

                            echo "
                            <script>
                                folder_list.push('$tmp01')
                            </script>";
                        }
                    }

                    $directory = dir($dir);
                    while(($file = $directory -> read()) != false)
                    {
                        if ( $file != '.' and $file != '..' and is_file($dir. '/'. $file))
                        {
                            $tmp01 = strtolower(str_replace(' ', '-', $file));
                            $lines = ArrayToString( file($dir . '/'. $file) );
                            if ($removeExtension) {
                                $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                                $file = substr($file, 0, -strlen(pathinfo($file, PATHINFO_EXTENSION)) - 1);
                            }
                            if ($removeExtension) {
                                $url = "http://localhost:8080/$program_local$program_name?theme=$theme&browse=http://localhost:8080/$program_local$dir/$file.$fileExtension";
                            }
                            else {
                                $url = "http://localhost:8080/$program_local$program_name?theme=$theme&browse=http://localhost:8080/$program_local$dir/$file";
                            }
                            
                            echo "
                            <div class='btn-division'>
                                <a href='$url' class='item $tmp01'>$file</a>
                                <svg viewBox='-47 0 512 512' class='btn-delete-file delete-$tmp01'>
                                    <path class='btn-delete-file delete-$tmp01' d='m416.875 114.441406-11.304688-33.886718c-4.304687-12.90625-16.339843-21.578126-29.941406-21.578126h-95.011718v-30.933593c0-15.460938-12.570313-28.042969-28.027344-28.042969h-87.007813c-15.453125 0-28.027343 12.582031-28.027343 28.042969v30.933593h-95.007813c-13.605469 0-25.640625 8.671876-29.945313 21.578126l-11.304687 33.886718c-2.574219 7.714844-1.2695312 16.257813 3.484375 22.855469 4.753906 6.597656 12.445312 10.539063 20.578125 10.539063h11.816406l26.007813 321.605468c1.933594 23.863282 22.183594 42.558594 46.109375 42.558594h204.863281c23.921875 0 44.175781-18.695312 46.105469-42.5625l26.007812-321.601562h6.542969c8.132812 0 15.824219-3.941407 20.578125-10.535157 4.753906-6.597656 6.058594-15.144531 3.484375-22.859375zm-249.320312-84.441406h83.0625v28.976562h-83.0625zm162.804687 437.019531c-.679687 8.402344-7.796875 14.980469-16.203125 14.980469h-204.863281c-8.40625 0-15.523438-6.578125-16.203125-14.980469l-25.816406-319.183593h288.898437zm-298.566406-349.183593 9.269531-27.789063c.210938-.640625.808594-1.070313 1.484375-1.070313h333.082031c.675782 0 1.269532.429688 1.484375 1.070313l9.269531 27.789063zm0 0'/>
                                    <path class='btn-delete-file delete-$tmp01' d='m282.515625 465.957031c.265625.015625.527344.019531.792969.019531 7.925781 0 14.550781-6.210937 14.964844-14.21875l14.085937-270.398437c.429687-8.273437-5.929687-15.332031-14.199219-15.761719-8.292968-.441406-15.328125 5.925782-15.761718 14.199219l-14.082032 270.398437c-.429687 8.273438 5.925782 15.332032 14.199219 15.761719zm0 0'/>
                                    <path class='btn-delete-file delete-$tmp01' d='m120.566406 451.792969c.4375 7.996093 7.054688 14.183593 14.964844 14.183593.273438 0 .554688-.007812.832031-.023437 8.269531-.449219 14.609375-7.519531 14.160157-15.792969l-14.753907-270.398437c-.449219-8.273438-7.519531-14.613281-15.792969-14.160157-8.269531.449219-14.609374 7.519532-14.160156 15.792969zm0 0'/>
                                    <path class='btn-delete-file delete-$tmp01' d='m209.253906 465.976562c8.285156 0 15-6.714843 15-15v-270.398437c0-8.285156-6.714844-15-15-15s-15 6.714844-15 15v270.398437c0 8.285157 6.714844 15 15 15zm0 0'/>
                                </svg>
                            </div>";

                            echo "
                            <script>
                                file_list.push('$tmp01')
                                delete_file_list.push('delete-$tmp01')
                                file_lines.push('$lines')
                            </script>";
                        }
                    }
                    $directory -> close();

                }

                function ArrayToString($array) {
                    $newString = '';
                    for ($x = 0; $x < count($array); ++$x) {
                        $newString = $newString. trim(
                            str_replace('<', '&#60;',
                            str_replace('>', '&#62;',
                            str_replace('\'', '&quot;',
                            str_replace('"', '&apos;',
                            $array[$x] ) ) ) ) );
                    }

                    return $newString;
                }

            ?>

        </div>

        <div id='error'>
            <svg viewBox='0 0 512 512'>
			    <path d='M507.113,428.415L287.215,47.541c-6.515-11.285-18.184-18.022-31.215-18.022c-13.031,0-24.7,6.737-31.215,18.022L4.887,428.415c-6.516,11.285-6.516,24.76,0,36.044c6.515,11.285,18.184,18.022,31.215,18.022h439.796c13.031,0,24.7-6.737,31.215-18.022C513.629,453.175,513.629,439.7,507.113,428.415z M481.101,449.441c-0.647,1.122-2.186,3.004-5.202,3.004H36.102c-3.018,0-4.556-1.881-5.202-3.004c-0.647-1.121-1.509-3.394,0-6.007L250.797,62.559c1.509-2.613,3.907-3.004,5.202-3.004c1.296,0,3.694,0.39,5.202,3.004L481.1,443.434C482.61,446.047,481.748,448.32,481.101,449.441z'/>
			    <rect x='240.987' y='166.095' width='30.037' height='160.197'/>
			    <circle cx='256.005' cy='376.354' r='20.025'/>
            </svg>

            <h2>No files found</h2>
        </div>

        <script>
            const $txbSearch = document.getElementById('txbSearch')
            const $error     = document.getElementById('error'    )

            $txbSearch.addEventListener('keyup', key => {

                if ($txbSearch.value.length != 0) {

                    try {

                        for (x = 0; x < folder_list.length; x++)
                        {
                            _tmp = document.getElementsByClassName(folder_list[x])[0].text

                            // if (_tmp.substring(0, $txbSearch.value.length) == $txbSearch.value)
                            if (_tmp.includes($txbSearch.value))
                            {
                                _tmp = document.getElementsByClassName(folder_list[x])
                                for (y = 0; y < _tmp.length; y++) {
                                    _tmp[y].style.display = 'block'
                                }
                            }
                            else {
                                _tmp = document.getElementsByClassName(folder_list[x])
                                for (y = 0; y < _tmp.length; y++) {
                                    _tmp[y].style.display = 'none'
                                }
                            }

                        }
                    } catch (error) { }

                    try {

                        for (x = 0; x < file_list.length; x++)
                        {
                            _tmp = document.getElementsByClassName(file_list[x])[0].text

                            // if (_tmp.substring(0, $txbSearch.value.length) == $txbSearch.value)
                            if (_tmp.includes($txbSearch.value))
                            {
                                _tmp = document.getElementsByClassName(file_list[x])
                                for (y = 0; y < _tmp.length; y++) {
                                    _tmp[y].style.display = 'block'
                                }
                            }
                            else {
                                _tmp = document.getElementsByClassName(file_list[x])
                                for (y = 0; y < _tmp.length; y++) {
                                    _tmp[y].style.display = 'none'
                                }
                            }

                        }
                    } catch (error) { }

                }
                else {
                    _tmp = $txbSearch.value.replace(' ', '-')

                    try {
                        for (x = 0; x < file_list.length; x++)
                        {
                            _tmp = document.getElementsByClassName(file_list[x])
                            for (y = 0; y < _tmp.length; y++) {
                                _tmp[y].style.display = 'block'
                            }
                        }

                        for (x = 0; x < folder_list.length; x++)
                        {
                            _tmp = document.getElementsByClassName(folder_list[x])
                            for (y = 0; y < _tmp.length; y++) {
                                _tmp[y].style.display = 'block'
                            }
                        }
                        
                    } catch (error) { }
                }

                _tmpBool = true
                for (x = 0; x < document.querySelectorAll('body div#initial a.item').length; x++)
                {
                    if (document.querySelectorAll('body div#initial a.item')[x].style.display == 'block') {
                        _tmpBool = false
                    }
                }

                if (_tmpBool)
                    document.getElementById('error').style.display = 'block'
                else
                    document.getElementById('error').style.display = 'none'

            })

            if (file_list.length == 0 || folder_list.len == 0) {
                $error.style.display = 'block'
            }

        </script>

    </div>

    <iframe src='' frameborder='0' id='iframe-file-functions'></iframe>

    <div id='popup-recreate-file'>
        <div class='content'>
            <p>Recriar arquivo apagado</p>
        </div>
    </div>

    <script>
        const $popup_recreate_file = document.getElementById        ('popup-recreate-file'  )
        const $iframe_delete_files = document.getElementById        ('iframe-file-functions')
        const $btn_info_file       = document.getElementsByClassName('btn-info-file'        )
        const $info_item           = document.getElementById        ('info-item'            )

        for (let x = 0; x < delete_file_list.length; x++)
        {
            _tmp = document.getElementsByClassName( delete_file_list[x] )

            _tmp[0].addEventListener('click', event => {
                _element_class = event.path[0].className.baseVal.split(' ')[1].substring(7)

                _element = document.getElementsByClassName( file_list[findArrayItem(file_list, _element_class)] )[0]
                _element_remove = document.getElementsByClassName( 'delete-' + file_list[findArrayItem(file_list, _element_class)] )[0]

                deleted_files.push( _element.text )
                deleted_files_number_lines.push( findArrayItem(file_list, _element_class) )

                $iframe_delete_files.src = 'http://localhost:8080/' + program_name + '?delete=' + _element.text

                _element.className = 'deleted-item'
                _element_remove.className.baseVal = 'deleted-item'

                file_list = removeArrayItem( file_list, file_list[findArrayItem(file_list, _element_class)] )
                delete_file_list = removeArrayItem( delete_file_list, delete_file_list[findArrayItem(file_list, _element_class)] )

                $popup_recreate_file.style.display = 'flex'
                setInterval(() => {
                    $popup_recreate_file.style.display = 'none'
                    deleted_files = removeArrayItem(deleted_files, deleted_files[deleted_files.length - 1])
                }, 90000)
            })
        }

        $popup_recreate_file.addEventListener('click', () => {
            _tmp = file_lines[deleted_files_number_lines[deleted_files_number_lines.length - 1]].
            replaceAll('#', '%23').
            replaceAll(' ', '%20').
            replaceAll('&', '%26').
            replaceAll('`', '%60').
            replaceAll('+', '%2B').
            replaceAll('&#60;', '%3C').
            replaceAll('&#62;', '%3E').
            replaceAll('&quot;', '%27').
            replaceAll('&apos;', '%27')

            $iframe_delete_files.src = 'http://localhost:8080/' + program_name + '?create=' + deleted_files[deleted_files.length - 1] + '&content=' + _tmp
            console.log( deleted_files_number_lines[deleted_files_number_lines.length - 1] )
            deleted_files_number_lines.pop()
            deleted_files.pop()

            if (deleted_files.length < 0) {
                $popup_recreate_file.style.display = 'none'
            }
        })

        function removeArrayItem($array, _item) {
            _newArray = []
            for (let x = 0; x < $array.length; x++) {
                if ($array[x] != _item) {
                    _newArray.push($array[x])
                }
            }

            return _newArray
        }

        function findArrayItem($array, _item) {
            for (x = 0; x < $array.length; x++) {
                if ($array[x] == _item) { return x }
            }
            return -1
        }

    </script>

    <?php
        createBrowser:

        if ($browse != false) {
            echo "
                <div id='buttons'>
                    <svg class='btnBrowser' onclick='javascript:history.go(-1)' viewBox='0 0 512 512'> <path d='M492,236H68.442l70.164-69.824c7.829-7.792,7.859-20.455,0.067-28.284c-7.792-7.83-20.456-7.859-28.285-0.068l-104.504,104c-0.007,0.006-0.012,0.013-0.018,0.019c-7.809,7.792-7.834,20.496-0.002,28.314c0.007,0.006,0.012,0.013,0.018,0.019l104.504,104c7.828,7.79,20.492,7.763,28.285-0.068c7.792-7.829,7.762-20.492-0.067-28.284L68.442,276H492c11.046,0,20-8.954,20-20C512,244.954,503.046,236,492,236z'/> </svg>
                    <svg class='btnBrowser btnReload' onclick='window.location.reload()' viewBox='0 0 458.186 458.186'><g transform='matrix(-1,0,0,1,458.1860580444336,0)'><path d='M445.651,201.95c-1.485-9.308-10.235-15.649-19.543-14.164c-9.308,1.485-15.649,10.235-14.164,19.543c0.016,0.102,0.033,0.203,0.051,0.304c17.38,102.311-51.47,199.339-153.781,216.719c-102.311,17.38-199.339-51.47-216.719-153.781S92.966,71.232,195.276,53.852c62.919-10.688,126.962,11.29,170.059,58.361l-75.605,25.19c-8.944,2.976-13.781,12.638-10.806,21.582c0.001,0.002,0.002,0.005,0.003,0.007c2.976,8.944,12.638,13.781,21.582,10.806c0.003-0.001,0.005-0.002,0.007-0.002l102.4-34.133c6.972-2.322,11.675-8.847,11.674-16.196v-102.4C414.59,7.641,406.949,0,397.523,0s-17.067,7.641-17.067,17.067v62.344C292.564-4.185,153.545-0.702,69.949,87.19s-80.114,226.911,7.779,310.508s226.911,80.114,310.508-7.779C435.905,339.799,457.179,270.152,445.651,201.95z'/> </svg>
                </div>
                <iframe id='browser' src='$browse' frameborder='0'></iframe>
            ";
                
        }

        end_program:
    ?>
</body>
</html>