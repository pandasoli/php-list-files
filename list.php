<!doctype html>
<html lang='en'>
<head>
    <meta charset='utf-8'/>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
    <?php
        $program_name = basename(__FILE__);
        $mode = isset( $_GET['mode'] ) ? $_GET['mode'] : 'light';
        $dir = isset( $_GET['search'] ) ? $_GET['search'] : './';
        $browse = isset( $_GET['browser'] ) ? $_GET['browser']  : false;
        $removeex = isset( $_GET['removeex'] ) ? $_GET['removeex'] : false;
        $tmp = '';

        echo "
            <script>
                let file_list = []
                let folder_list = []
                let mode = '$mode'
                let program_name = '$program_name'
                let dir = '$dir'
            </script>
        ";
    ?>

    <style>
        :root {
            --background-color: #f6f8fa;
            --scrollbar-thumb-background-color: rgba(17, 88, 199, 1);

            --btn-focus-box-shadow: 0px 0px 0px 3px rgba(17, 88, 199, .4);

            --txb-background-color: #fafbfc;

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

            --first-font-color: #24292e;
            --second-font-color: #fff;
            --form-background-color: #fff;
            --form-border-color: #e1e4e8;
        }

        <?php
            if ($mode == 'darkness') {
                echo "
                :root {
                    --background-color: #06090f;
                    --scrollbar-thumb-background-color: rgba(17, 88, 199, 1);

                    --btn-focus-box-shadow: 0px 0px 0px 3px rgba(17, 88, 199, .4);

                    --txb-background-color: #0d1117;

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

                    --first-font-color: #c9d1d9;
                    --second-font-color: #fff;
                    --form-background-color: #0d1117;
                    --form-border-color: #30363d;
                }
                ";
            }
        ?>

        ::-webkit-scrollbar {
            width: 7px;
            height: 7px;
            background-color: var(--background-color);
        }
        ::-webkit-scrollbar-thumb {
            background-color: var(--scrollbar-thumb-background-color);
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

        body div#initial {
            max-width: 500px;
            width: 90%;
            height: auto;
            min-height: 340px;
            display: block;
            position: relative;
            margin: 50px auto 50px auto;
            background-color: var(--form-background-color);
            color: var(--first-font-color);
            text-align: center;
            border-radius: 6px;
            padding: 4px;
            padding-bottom: 6px;
            border: 1px solid var(--form-border-color);
        }

        /* Error */
        body div#initial div#error {
            display: none;
            margin-top: 50px;
        }

        body div#initial div#error svg {
            fill: var(--first-btn-background-color);
            width: 100px;
        }

        body div#initial div#error h2 {
            color: var(--first-btn-background-color);
            font-size: 14pt;
            margin: 0px;
        }

        /* Buttons */
        body div#initial div#buttons {
            padding-top: 8px;
        }

        body div#initial div#buttons a.item {
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
        body div#initial div#buttons a.item:hover {
            color: var(--first-btn-hover-font-color);
            background-color: var(--first-btn-hover-background-color);
            border: 1px solid var(--first-btn-hover-border-color);
        }
        body div#initial div#buttons a.item:active {
            background-color: var(--first-btn-active-background-color);
        }
        body div#initial div#buttons a.item:focus {
            /* box-shadow: var(--btn-focus-box-shadow); */
            /* border: 1px solid var(--first-btn-hover-border-color); */
            color: var(--first-btn-hover-font-color);
            background-color: var(--first-btn-hover-background-color);
            border: 1px solid var(--first-btn-hover-border-color);
        }

        body div#initial div#buttons a.item.btn-folder {
            color: var(--second-btn-font-color);
            background-color: var(--second-btn-background-color);
            border: 1px solid var(--second-btn-border-color);
        }
        body div#initial div#buttons a.item.btn-folder:hover {
            color: var(--second-btn-hover-font-color);
            border: 1px solid var(--second-btn-hover-border-color);
            background-color: var(--second-btn-hover-background-color);
        }
        body div#initial div#buttons a.item.btn-folder:active {
            background-color: var(--second-btn-active-background-color);
            color: var(--second-btn-hover-font-color);
        }
        body div#initial div#buttons a.item.btn-folder:focus {
            color: var(--second-btn-hover-font-color);
            border: 1px solid var(--second-btn-hover-border-color);
            background-color: var(--second-btn-hover-background-color);
            
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
            border: 1px solid var(--first-btn-background-color);
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
        body div#initial div#header input#txbSearch:focus {
            border: 1px solid var(--second-btn-hover-border-color);
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

    </style>

    <link rel='icon' href='https://icons.iconarchive.com/icons/papirus-team/papirus-mimetypes/256/app-x-php-icon.png'/>
    <title>&#60;/&#62; File list on server</title>
</head>
<body id='body'>

    <?php
        if ($browse != false) {
            goto createBrowser;
        }
    ?>

    <div id='initial'>

        <div id='header'>
            <div id='title'>
                <svg class='top-buttons' onclick='javascript:history.go(-1)' viewBox='0 0 512 512'> <path d='M492,236H68.442l70.164-69.824c7.829-7.792,7.859-20.455,0.067-28.284c-7.792-7.83-20.456-7.859-28.285-0.068l-104.504,104c-0.007,0.006-0.012,0.013-0.018,0.019c-7.809,7.792-7.834,20.496-0.002,28.314c0.007,0.006,0.012,0.013,0.018,0.019l104.504,104c7.828,7.79,20.492,7.763,28.285-0.068c7.792-7.829,7.762-20.492-0.067-28.284L68.442,276H492c11.046,0,20-8.954,20-20C512,244.954,503.046,236,492,236z'/> </svg>
                <h1>File list on server</h1>
                <svg class='top-buttons' onclick='window.location.reload()' viewBox='0 0 458.186 458.186'><g transform='matrix(-1,0,0,1,458.1860580444336,0)'><g> <path d='M445.651,201.95c-1.485-9.308-10.235-15.649-19.543-14.164c-9.308,1.485-15.649,10.235-14.164,19.543c0.016,0.102,0.033,0.203,0.051,0.304c17.38,102.311-51.47,199.339-153.781,216.719c-102.311,17.38-199.339-51.47-216.719-153.781S92.966,71.232,195.276,53.852c62.919-10.688,126.962,11.29,170.059,58.361l-75.605,25.19c-8.944,2.976-13.781,12.638-10.806,21.582c0.001,0.002,0.002,0.005,0.003,0.007c2.976,8.944,12.638,13.781,21.582,10.806c0.003-0.001,0.005-0.002,0.007-0.002l102.4-34.133c6.972-2.322,11.675-8.847,11.674-16.196v-102.4C414.59,7.641,406.949,0,397.523,0s-17.067,7.641-17.067,17.067v62.344C292.564-4.185,153.545-0.702,69.949,87.19s-80.114,226.911,7.779,310.508s226.911,80.114,310.508-7.779C435.905,339.799,457.179,270.152,445.651,201.95z'/> </g> </svg>
            </div>

            <input type='text' id='txbSearch'/>
        </div>

        <div id='buttons'>

            <?php

                $directory = dir($dir);
                while(($folder = $directory -> read()) != false)
                {
                    if ( $folder != '.' and $folder != '..' and is_dir($dir. '/'. $folder) )
                    {
                        $tmp = strtolower(str_replace(' ', '-', $folder));
                        echo "<a href='http://localhost:8080/$program_name?search=$dir/$folder&mode=$mode' class='item $tmp btn-folder'>$folder</a>";
                        echo "
                        <script>
                            folder_list.push('$tmp')
                        </script>";
                    }
                }

                $directory = dir($dir);
                while(($file = $directory -> read()) != false)
                {
                    if ( $file != '.' and $file != '..' and is_file($dir. '/'. $file))
                    {
                        $tmp = strtolower(str_replace(' ', '-', $file));
                        if ($removeex) { $file = substr($file, 0, -strlen(pathinfo($file, PATHINFO_EXTENSION)) - 1); }
                        echo "<a href='http://localhost:8080/$program_name?mode=$mode&browser=http://localhost:8080/$dir/$file' class='item $tmp'>$file</a>";
                        echo "
                        <script>
                            file_list.push('$tmp')
                        </script>";
                    }
                }
                $directory -> close();

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
            let tmp = ''
            let tmpbool

            $txbSearch.addEventListener('keyup', key => {

                if ($txbSearch.value.length != 0) {

                    try {

                        for (x = 0; x < folder_list.length; x++)
                        {
                            tmp = document.getElementsByClassName(folder_list[x])[0].text

                            // if (tmp.substring(0, $txbSearch.value.length) == $txbSearch.value)
                            if (tmp.includes($txbSearch.value))
                            {
                                tmp = document.getElementsByClassName(folder_list[x])
                                for (y = 0; y < tmp.length; y++) {
                                    tmp[y].style.display = 'block'
                                }
                            }
                            else {
                                tmp = document.getElementsByClassName(folder_list[x])
                                for (y = 0; y < tmp.length; y++) {
                                    tmp[y].style.display = 'none'
                                }
                            }

                        }
                    } catch (error) { }

                    try {

                        for (x = 0; x < file_list.length; x++)
                        {
                            tmp = document.getElementsByClassName(file_list[x])[0].text

                            // if (tmp.substring(0, $txbSearch.value.length) == $txbSearch.value)
                            if (tmp.includes($txbSearch.value))
                            {
                                tmp = document.getElementsByClassName(file_list[x])
                                for (y = 0; y < tmp.length; y++) {
                                    tmp[y].style.display = 'block'
                                }
                            }
                            else {
                                tmp = document.getElementsByClassName(file_list[x])
                                for (y = 0; y < tmp.length; y++) {
                                    tmp[y].style.display = 'none'
                                }
                            }

                        }
                    } catch (error) { }

                }
                else {
                    tmp = $txbSearch.value.replace(' ', '-')

                    try {
                        for (x = 0; x < file_list.length; x++)
                        {
                            tmp = document.getElementsByClassName(file_list[x])
                            for (y = 0; y < tmp.length; y++) {
                                tmp[y].style.display = 'block'
                            }
                        }

                        for (x = 0; x < folder_list.length; x++)
                        {
                            tmp = document.getElementsByClassName(folder_list[x])
                            for (y = 0; y < tmp.length; y++) {
                                tmp[y].style.display = 'block'
                            }
                        }
                        
                    } catch (error) { }
                }

                tmpbool = true
                for (x = 0; x < document.querySelectorAll('body div#initial a.item').length; x++)
                {
                    if (document.querySelectorAll('body div#initial a.item')[x].style.display == 'block') {
                        tmpbool = false
                    }
                }

                if (tmpbool)
                    document.getElementById('error').style.display = 'block'
                else
                    document.getElementById('error').style.display = 'none'

            })

            if (file_list.length == 0 || folder_list.len == 0) {
                $error.style.display = 'block'
            }

        </script>

    </div>

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
    ?>
</body>
</html>