<?php

namespace Checkternary\CheckTernary;

class CheckTernary
{
    /**
     * Summary of ignoredFolders
     */
    public array $ignoredFolders;

    public array $folderPath;

    public function __construct()
    {

        $this->folderPath = config('checkternary.folderPaths');

        $this->ignoredFolders = config('checkternary.ignoredFolders');

    }

    /**
     * Summary of checkTernaryConditionsInFiles
     *
     * @return mixed
     */
    public static function checkTernaryConditionsInFiles(array $folderPaths, array $ignoredFolders)
    {

        foreach ($folderPaths as $folderPath) {

            $files = scandir($folderPath);

            foreach ($files as $file) {
                if ($file === '.' || $file === '..') {
                    continue;
                }

                $filePath = $folderPath.DIRECTORY_SEPARATOR.$file;
                if (is_dir($filePath)) {
                    if (in_array($file, $ignoredFolders)) {
                        continue;
                    }

                    self::checkTernaryConditionsInFiles([$filePath], $ignoredFolders);
                } elseif (is_file($filePath)) {
                    $viewContent = file_get_contents($filePath);

                    return self::checkTernaryConditionsInView($filePath, $viewContent);
                }
            }
        }
    }

    public static function checkTernaryConditionsInView($filePath, $viewContent)
    {
        $configFormat = config('checkternary.ternary_formats');
        $lines = explode(PHP_EOL, $viewContent);

        $output = '';

        foreach ($lines as $lineNumber => $lineContent) {

            // Recherche des parties de la ligne contenant des variables
            preg_match_all('/\$\w+/', $lineContent, $variables);

            // Si des variables sont trouvées dans la ligne
            if (! empty($variables[0])) {

                $variableMatchCount = count($variables[0]);

                // Vérifie si la variable a été utilisée dans une condition ternaire
                preg_match_all('/'.preg_quote($configFormat, '/').'/', $lineContent, $matches);
                //dd($matches, $format, $lineContent);

                if (empty($matches[0])) {
                    foreach ($variables[0] as $key => $variableName) {
                        // code...
                        $output .= "Line $lineNumber: $filePath";
                        $output .= '  ==>  '.$lineContent.PHP_EOL;
                    }
                } else {
                    $regexMatchCount = count($matches[0]);
                    if ($regexMatchCount != $variableMatchCount) {
                        foreach ($variables[0] as $key => $variableName) {
                            $output .= "x$regexMatchCount-$variableMatchCount Line $lineNumber: $filePath";
                            $output .= '  ==>  '.$lineContent.PHP_EOL;
                        }
                    }
                }

            }
        }
        echo $output;
    }
}
