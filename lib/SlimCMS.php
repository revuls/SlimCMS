<?php
/**
 * Created by PhpStorm.
 * User: credondo
 * Date: 11/6/13
 * Time: 6:20 PM
 */

namespace lib;


class SlimCMS {

    // Get the config
    public static function getTwigVars(){
        $config = SlimCMS::getConfig();
        $menus = SlimCMS::getMenu('menu');
        $pages = SlimCMS::getAllFrom('pages');
        $blog = SlimCMS::getAllFrom('blog');
        $themes = SlimCMS::getThemes($config['path']."/themes");

        $twig_vars = array(
            'config' => $config,
            'menus' => $menus,
            'pages' => $pages,
            'blog' => $blog,
            'themes' => $themes
        );

        return $twig_vars;
    }

    // Get the config
    public static function getConfig(){
        if ($_SERVER['HTTP_HOST'] == "localhost")
            $folder = "/SlimCMS";
        else
            $folder = "";

        $path = $_SERVER['DOCUMENT_ROOT'].$folder;
        $url = "http://".$_SERVER['HTTP_HOST'].$folder;

        $config = Json::read("content/config.json");

        if (!isset($config['url']) || $config['url'] == "")
            $config['url'] = $url;
        $config['path'] = $path;
        return $config;
    }

    // Get all the Elements by Folder
    public static function getAllFrom($folder) {
        $iterator = new \DirectoryIterator("content/".$folder);
        $files = new \RegexIterator($iterator,'/\\'."json".'$/');
        foreach($files as $file){
            if($file->isFile()){
                $array = Json::read("content/".$folder."/". $file->getFilename());
                $fileNames[$array['Slug']] = $array;
            }
        }
        if ($folder == "blog")
            return array_reverse($fileNames);
        else
            return $fileNames;
    }

    // Get all From Menu
    public static function getMenu($folder) {
        $iterator = new \DirectoryIterator("content/".$folder);
        $files = new \RegexIterator($iterator,'/\\'."json".'$/');
        foreach($files as $file){
            if($file->isFile()){
                $menu = Json::read("content/".$folder."/". $file->getFilename());
                $fileNames[str_replace(".json", "", $file->getFilename())] = $menu;
            }
        }
        if (isset($fileNames))
            return $fileNames;
        else
            return "";
    }

    // Get all the Templates by Folder
    public static function getTemplates($path) {
        $path = $path."templates/";
        if(is_dir($path)) {
            $iterator = new \DirectoryIterator($path);
            $files = new \RegexIterator($iterator,'/\\'.".html".'$/');
            foreach($files as $file){
                if($file->isFile()){
                    $fileNames[] = $file->getFilename();
                }
            }
        }
        if (isset($fileNames))
            return $fileNames;
        else
            return "";
    }

    // Get all the Media
    public static function getMedia($url) {
        $dirname = "content/media/";
        $images = glob($dirname."*.{jpg,jpeg,png,gif}", GLOB_BRACE);
        foreach($images as $image) {
            $fileNames[$image]['image'] = $url. "/". $image;
            $fileNames[$image]['name'] = str_replace($dirname, "", $image);
        }
        if (isset($fileNames))
            return $fileNames;
        else
            return "";
    }

    // Get the Themes
    public static function getThemes($folder){
        $themes = array_diff(scandir($folder), array('..', '.'));
        return $themes;
    }

    // Insert a new Json file
    public static function saveJsonTo($data, $folder) {
        if ($folder == "content/blog/")
            $fp = fopen($folder . $data['DateTime'] . "_" . $data["Slug"]. '.json', 'w');
        else if ($folder == "content/")
            $fp = fopen($folder .'config.json', 'w');
        else
            $fp = fopen($folder . $data["Slug"]. '.json', 'w');
        fwrite($fp, json_encode($data));
        fclose($fp);
    }

    // Insert a new Json file
    public static function saveJsonToMenu($data, $file, $folder) {
        $fp = fopen($folder . $file . '.json', 'w');
        fwrite($fp, json_encode($data));
        fclose($fp);
    }

    // Deletes a Json file
    public static function delJson($file, $folder) {
        unlink($folder . $file . ".json");
    }

    // Deletes a file
    public static function delFile($file, $folder) {
        unlink($folder . $file);
    }
} 