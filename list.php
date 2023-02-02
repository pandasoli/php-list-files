<!doctype html>
<html lang='en'>
<head>
    <meta charset='utf-8'/>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
    <?php
        $mode = isset( $_GET['mode'] ) ? $_GET['mode'] : 'light';
    ?>

    <style>
        :root {
            --white-color: rgb(255, 255, 255);
            --gray-color: rgb(36, 41, 46);
            --blue-color: rgb(3, 102, 214);
            --green-color: rgb(46, 164, 79);

            --faint-gray-border: 1px solid rgb(225, 228, 232);
            --first-btn-color: rgb(243, 244, 246);
            --first-btn-shadow-color: rgb(211, 212, 214);
            --btn-active-border: rgba(3, 102, 214 , .3);
            --font-color: rgb(36, 41, 46);
            --form-color: transparent;
        }

        <?php
            if ($mode == 'darkness') {
                echo "
                :root {
                    --white-color: rgb(36, 41, 46);
                    --gray-color: rgb(36, 41, 46);
                    --blue-color: rgb(3, 102, 214);
                    --green-color: rgb(46, 164, 79);
                    
                    --faint-gray-border: 1px solid rgb(24, 26, 31);
                    --first-btn-color: rgb(78, 85, 94);
                    --first-btn-shadow-color: rgb(84, 87, 91);
                    --btn-active-border: rgba(3, 102, 214 , .3);
                    --font-color: rgb(210, 210, 210);
                    --form-color: rgb(49, 54, 63);
                }
                ";
            }
        ?>

        ::-webkit-scrollbar {
            width: 7px;
            height: 7px;
            background-color: var(--white-color);
        }
        ::-webkit-scrollbar-thumb {
            background-color: var(--blue-color);
        }

        body {
            margin: 0px;
            background-color: var(--white-color);
            font-family: -apple-system, BlinkMacSystemFont, Segoe UI, Helvetica, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji;
        }

        body div#initial {
            width: 500px;
            height: auto;
            min-height: 340px;
            display: block;
            position: relative;
            margin: 10% auto 10% auto;
            background-color: var(--form-color);
            color: var(--font-color);
            text-align: center;
            border-radius: 6px;
            padding: 4px;
            padding-bottom: 6px;
            border: var(--faint-gray-border);
        }

        body div#initial h1 {
            font-size: 18pt;
            margin: 0px;
            margin-bottom: 20px;
            display: inline-block;
        }

        body div#initial a {
            text-decoration: none;
            display: block;
            width: 80%;
            text-align: center;
            margin: 6px auto 6px auto;
            background-color: var(--first-btn-color);
            border-radius: 4px;
            height: 22px;
            color: var(--font-color);
            line-height: 1.3rem;
            border: 1px solid var(--first-btn-shadow-color);
        }
        body div#initial a:active { box-shadow: 0px 0px 0px 3px var(--btn-active-border); }

        body div#initial a.btn-folder {
            background-color: var(--blue-color);
            <?php
                if ($mode == 'light') {
                    echo 'color: var(--white-color);';
                }
            ?>
            border-color: var(--blue-color);
        }

        body div#initial a.this-file {
            background-color: var(--white-color);
            <?php
                if ($mode == 'darkness') {
                    echo 'border-color: var(--white-color);';
                }
            ?>
        }

        body div#initial svg#btnBack {
            width: 20px;
            height: 20px;
            border: none;
            background-color: transparent;
            border-radius: 0px;
            display: inline-block;
            position: relative;
            left: -60px;
            fill: var(--font-color);
        }
        body div#initial svg#btnBack:hover { box-shadow: none; }


    </style>

    <title>List of php files</title>
</head>
<body>
    <div id='initial'>
        <svg version='1.1' fill='#d2d2d2' id='btnBack'  onclick='javascript:history.go(-1)' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' width='20' height='20' style='position: relative; display: inline-block; left: -60px;' viewBox='0 0 512 512' style='enable-background:new 0 0 512 512;' xml:space='preserve'>
            <g>
                <path d='M492,236H68.442l70.164-69.824c7.829-7.792,7.859-20.455,0.067-28.284c-7.792-7.83-20.456-7.859-28.285-0.068l-104.504,104c-0.007,0.006-0.012,0.013-0.018,0.019c-7.809,7.792-7.834,20.496-0.002,28.314c0.007,0.006,0.012,0.013,0.018,0.019l104.504,104c7.828,7.79,20.492,7.763,28.285-0.068c7.792-7.829,7.762-20.492-0.067-28.284L68.442,276H492c11.046,0,20-8.954,20-20C512,244.954,503.046,236,492,236z'/>
            </g>
        </svg>

        <h1>List of php files in this folder</h1>

        <?php
            $dir = isset( $_GET['q'] ) ? $_GET['q'] : './';

            $program_name = basename(__FILE__);
            $directory = dir($dir);
            while(($file = $directory -> read()) != false)
            {
                if ( $file != '.' and $file != '..' and is_dir($dir. '/'. $file) )
                {
                    echo "<a href='http://localhost:8080/$program_name?q=$dir/$file&mode=$mode' class='btn-folder'> $file </a>";
                }
            }

            $directory = dir($dir);
            while(($file = $directory -> read()) != false)
            {
                if ( $file != '.' and $file != '..' and is_file($dir. '/'. $file) )
                {
                    echo "<a href='http://localhost:8080/$dir/$file' class='btn-file";

                    if ($file == $program_name) {
                        echo " this-file";
                    }

                    echo "'> $file </a>";
                }
            }
            $directory -> close();
    
        ?>
    </div>
</body>
</html>