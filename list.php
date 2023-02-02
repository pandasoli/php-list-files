<!doctype html>
<html lang='en'>
<head>
    <meta charset='utf-8'/>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'/>

    <style>
        body {
            margin: 0px;
            background-color: rgb(12, 12, 12);
            font-family: Arial;
        }

        body div#initial {
            width: 500px;
            height: auto;
            min-height: 340px;
            display: block;
            position: relative;
            margin: 10% auto 0px auto;
            background-color: rgb(50, 50, 50);
            color: rgb(200, 200, 200);
            text-align: center;
            border-radius: 6px;
            padding: 4px;
            border: 1px solid rgb(24, 26, 31);
        }

        body div#initial h1 {
            font-size: 18pt;
            margin: 0px;
            margin-bottom: 20px;
            display: inline-block;
        }

        body div#initial a {
            text-decoration: none;
            color: rgb(210, 210, 210);
            display: block;
            width: 80%;
            text-align: center;
            margin: 6px auto 6px auto;
            background-color: rgba(0, 0, 0, .4);
            border-radius: 4px;
            height: 22px;
            line-height: 1.5rem;
            border: 1px solid rgb(24, 26, 31);
        }
        body div#initial a:hover {
            box-shadow: 0 0 0 3px rgba(3, 102, 214 , .3);
        }

        body div#initial a#btnBack {
            width: 20px;
            height: 20px;
            border: none;
            background-color: transparent;
            border-radius: 0px;
            display: inline-block;
            top: 8px;
            position: relative;
            left: -60px;
        }
        body div#initial a#btnBack:hover { box-shadow: none; }


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
            loadDirectory($dir, $dir);
            
            function loadDirectory($folder, $dir) {
                $programname = basename(__FILE__);
                $directory = dir($folder);
                while(($file = $directory -> read()) != false)
                {
                    if ( $file != '.' and $file != '..' and is_dir($dir. '/'. $file) )
                    {
                        echo "<a href='http://localhost:8080/$programname?q=$dir/$file' style='background-color: rgba(100, 100, 100, .34);'> $file </a>";
                    }
                }
                $directory -> close();

                $directory = dir($folder);
                while(($file = $directory -> read()) != false)
                {
                    if ( $file != '.' and $file != '..' and is_file($dir. '/'. $file) )
                    {
                        echo "<a href='http://localhost:8080/$dir/$file' style='background-color: rgba(0, 0, 0, .4);'> $file </a>";
    
                        if ($file == $programname) {
                            echo "
                            <svg width='16px' version='1.1' id='Capa_1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' style='display: block; position: relative; left: 31%; top: -25px; margin: 0px;' viewBox='0 0 511.999 511.999' style='enable-background:new 0 0 511.999 511.999;' xml:space='preserve'>
                            <path style='fill:#FFDC64;' d='M452.71,157.937l-133.741-12.404L265.843,22.17c-3.72-8.638-15.967-8.638-19.686,0l-53.126,123.362 L59.29,157.937c-9.365,0.868-13.149,12.516-6.084,18.723l100.908,88.646l-29.531,131.029c-2.068,9.175,7.841,16.373,15.927,11.572 L256,339.331l115.49,68.576c8.087,4.802,17.994-2.397,15.927-11.572l-29.532-131.029l100.909-88.646 C465.859,170.453,462.074,158.805,452.71,157.937z'/>
                            <g>
                                <path style='fill:#FFF082;' d='M119.278,17.923c6.818,9.47,26.062,50.14,37.064,73.842c1.73,3.726-2.945,7.092-5.93,4.269 C131.425,78.082,98.96,46.93,92.142,37.459c-5.395-7.493-3.694-17.941,3.8-23.336C103.435,8.728,113.883,10.43,119.278,17.923z'/>
                                <path style='fill:#FFF082;' d='M392.722,17.923c-6.818,9.47-26.062,50.14-37.064,73.842c-1.73,3.726,2.945,7.092,5.93,4.269 c18.987-17.952,51.451-49.105,58.27-58.575c5.395-7.493,3.694-17.941-3.8-23.336C408.565,8.728,398.117,10.43,392.722,17.923z'/>
                                <path style='fill:#FFF082;' d='M500.461,295.629c-11.094-3.618-55.689-9.595-81.612-12.875c-4.075-0.516-5.861,4.961-2.266,6.947 c22.873,12.635,62.416,34.099,73.51,37.717c8.778,2.863,18.215-1.932,21.078-10.711 C514.034,307.928,509.239,298.492,500.461,295.629z'/>
                                <path style='fill:#FFF082;' d='M11.539,295.629c11.094-3.618,55.689-9.595,81.612-12.875c4.075-0.516,5.861,4.961,2.266,6.947 c-22.873,12.635-62.416,34.099-73.51,37.717c-8.778,2.863-18.215-1.932-21.078-10.711S2.761,298.492,11.539,295.629z'/>
                                <path style='fill:#FFF082;' d='M239.794,484.31c0-11.669,8.145-55.919,13.065-81.582c0.773-4.034,6.534-4.034,7.307,0 c4.92,25.663,13.065,69.913,13.065,81.582c0,9.233-7.485,16.718-16.718,16.718C247.279,501.029,239.794,493.543,239.794,484.31z'/>
                            </g>
                            <path style='fill:#FFC850;' d='M285.161,67.03l-19.319-44.86c-3.72-8.638-15.967-8.638-19.686,0L193.03,145.532L59.29,157.937 c-9.365,0.868-13.149,12.516-6.084,18.723l100.908,88.646l-29.531,131.029c-2.068,9.175,7.841,16.373,15.927,11.572l15.371-9.127 C181.08,235.66,251.922,115.918,285.161,67.03z'/>";
                        }
                    }
                }
                $directory -> close();
    
                
            }
        ?>
    </div>
</body>
</html>