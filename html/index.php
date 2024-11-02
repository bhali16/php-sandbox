<?php
$arrFiles = array();
$dockerPath = '/var/www/html'; // Docker container path
$localPath = '/Users/waqar/GitHub/php-sandbox/html'; // Your local machine path
$dirPath = "./";

?>

<html>
<head>
    <title>Project Files</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>

<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow rounded-lg p-6">
        <div class="border-b border-gray-200 pb-4 mb-4">
            <h2 class="text-2xl font-bold text-gray-800">Projects</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php
            $files = glob($dirPath . "/*");
            foreach ($files as $file) {
                $basename = basename($file);
                if ($basename === 'index.php') continue;

                if (is_file($file)) {
                    ?>
                    <div class="border rounded-lg p-4 hover:shadow-lg transition-shadow">
                        <div class="flex flex-col space-y-4">
                            <div class="flex items-center">
                                <svg class="h-5 w-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span class="text-gray-700 font-medium"><?php echo $basename; ?></span>
                            </div>
                            <a href="<?php echo $file; ?>"
                               class="text-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                               target="_blank">
                                Open File
                            </a>
                        </div>
                    </div>
                    <?php
                 } elseif (is_dir($file)) {
                    $absolutePath = str_replace('\\', '/', realpath($file));
                    // Replace Docker path with local path
                    $localAbsolutePath = str_replace($dockerPath, $localPath, $absolutePath);
                    ?>
                    <div class="border rounded-lg p-4 hover:shadow-lg transition-shadow">
                        <div class="flex flex-col space-y-4">
                            <div class="flex items-center">
                                <svg class="h-5 w-5 mr-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"/>
                                </svg>
                                <span class="text-gray-700 font-medium"><?php echo $basename; ?></span>
                            </div>
                            <div class="flex flex-col space-y-2">
                                <a href="<?php echo $file; ?>"
                                   class="text-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    View Project
                                </a>
                                <a href="vscode://file<?php echo $localAbsolutePath; ?>"
                                   class="text-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    Open in VSCode
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>

    <!-- Database Card -->
    <div class="bg-white shadow rounded-lg p-6 mt-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                </svg>
                <span class="font-medium">MySQL <small>[username: root, password: password]</small></span>
                
            </div>
            <a href="http://localhost:8082/"
               class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
               target="_blank">
                Access
            </a>
        </div>
    </div>
    <div class="bg-white shadow rounded-lg p-6 mt-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                </svg>
                <span class="font-medium">PostgreSQL <small>[username: admin@admin.com, password: password]</small></span>
                
            </div>
            <a href="http://localhost:8083/"
               class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
               target="_blank">
                Access
            </a>
        </div>
    </div>


    <!-- Footer -->
    <div class="bg-gray-800 text-white py-4 text-center rounded-lg mt-4">
        <p><a href="mailto:waqarbinmuhammad@gmail.com" class="hover:text-gray-300 transition-colors">waqarbinmuhammad@gmail.com</a></p>
    </div>
</div>
</body>
</html>