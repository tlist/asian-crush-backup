<?php
defined('_PF_THEME_DEV') or define('_PF_THEME_DEV', TRUE);

class PfBase
{
	private static $_app;
	
	public static function initTheme($arrConfig=NULL)
	{
		return new PfTheme($arrConfig);
	}
	
	/**
	 * Returns the application singleton, null if the singleton has not been created yet.
	 * @return CApplication the application singleton, null if the singleton has not been created yet.
	 */
	public static function app()
	{
		return self::$_app;
	}
	
	/**
	 * Stores the application instance in the class static member.
	 * This method helps implement a singleton pattern for PfTheme.
	 * Repeated invocation of this method or the PfTheme constructor
	 * will cause the throw of an exception.
	 * To retrieve the application instance, use {@link app()}.
	 * @param $app the application instance. If this is null, the existing
	 * application singleton will be removed.
	 * @throws Exception if multiple application instances are registered.
	 */
	public static function setApplication($app)
	{
		if(self::$_app===null || $app===null)
			self::$_app=$app;
		else
			throw new Exception("PfBase app can only created once");
	}
	
	/**
	 * Get the content of a file in the theme for blocks
	 * @param name (inner path included) of the file
	 * @return content of the file
	 */
	public static function getBlock($strFilePath)
	{
		$arg_list = func_get_args();
		$strFilePath = PfBase::app()->themePath.DS.$strFilePath;
		
		if (is_file($strFilePath)) 
		{
			$arg_list = func_get_args();
				
			if (isset($arg_list[1]))
				extract($arg_list[1]);
			
			if (isset($cacheLifetime)) $cacheLifetime = (int) $cacheLifetime;
			else $cacheLifetime = null;
			$strKey = md5(serialize($arg_list));
			
			/* if cacheLifetime = zero, disable cache */
			$result = $cacheLifetime !== 0 ? self::app()->getCache($strKey) : null;
			if (!$result)
			{
				ob_start();
			    require $strFilePath;
			    $result = ob_get_clean();
				
				/* if cacheLifetime = zero, disable cache */
				if ($cacheLifetime !== 0)
					self::app()->setCache($strKey, $result, $cacheLifetime);
			}
			return $result;
		}
		return null;
	}
	
	/**
	 * Empty Directory
	 * @param filepath of the directory
	 * @param delete the directory itself or not
	 */
	public static function emptyDir($dir, $deleteMe=0) {
	    if(!$dh = @opendir($dir)) return;
	    while (false !== ($obj = readdir($dh))) {
	        if($obj=='.' || $obj=='..') continue;
	        if (!@unlink($dir.'/'.$obj)) self::emptyDir($dir.'/'.$obj, true);
	    }
	
	    closedir($dh);
	    if ($deleteMe){
	        @rmdir($dir);
	    }
	}
}

class PfTheme
{
	public $themePath;
	public $themeUrl;
	
	public $cachePath;
	public $cacheEnabled = 0;
	
	/** 
	 * Default cache lifetime for blocks, zero means not cache.
	 */
	public $cacheLifetime = 0;
	public $params;
	
	/**
	 * Constructor.
	 * @param mixed $config application configuration.
	 * If a string, it is treated as the path of the file that contains the configuration;
	 * If an array, it is the actual configuration information.
	 * Please make sure you specify the {@link getBasePath basePath} property in the configuration,
	 * which should point to the directory containing all application logic, template and data.
	 * If not, the directory will be defaulted to 'protected'.
	 */
	public function __construct($config=null)
	{
		PfBase::setApplication($this);
		
		// set basePath at early as possible to avoid trouble
		if(is_string($config))
			$config=require($config);
		
		if(isset($config['themePath']))
		{
			$this->themePath = $config['themePath'];
			unset($config['themePath']);
		}
		else
			$this->themePath = dirname(__FILE__).DIRECTORY_SEPARATOR.'..';
		
		if(isset($config['themeUrl']))
		{
			$this->themeUrl = $config['themeUrl'];
			unset($config['themeUrl']);
		}
		else
			$this->themeUrl = get_bloginfo('stylesheet_directory');
		
		/**
		 * Set Cache path for the theme
		 */
		if(isset($config['cachePath']))
		{
			$this->cachePath = $config['cachePath'];
			unset($config['cachePath']);
		}
		else
			$this->cachePath = $this->themePath.DS.'cache';
		@mkdir($this->cachePath,0777,true);
		/**
		 * Enable caching or not
		 */
		if(isset($config['cacheEnabled']) )
		{
			$this->cacheEnabled = $config['cacheEnabled'] ? true : false;
			unset($config['cacheEnabled']);
		}
		
		/**
		 * Set Cache Lifetime for the blocks of the theme
		 */
		if(isset($config['cacheLifetime']))
		{
			$this->cacheLifetime = (int)$config['cacheLifetime'];
			if ($this->cacheLifetime < 0) $this->cacheLifetime = 0;
			unset($config['cacheLifetime']);
		}
		
		if(isset($config['params']))
		{
			$this->params = $config['params'];
			unset($config['params']);
		}
		
	}
	
	public function getCache($strKey='')
	{
		if (!$this->cacheEnabled)
			return false;
		
		/* get caching filename */
		$cacheFile = $this->cachePath.DS.$strKey.'.html';
		if(($time=@filemtime($cacheFile))>time())
			return file_get_contents($cacheFile);
		else if($time>0)
			@unlink($cacheFile);
		return false;
	}
	
	public function setCache($strKey, $strValue, $expire=1800)
	{
		if((int)$expire<=0)
			$expire=$this->cacheLifetime; // 1 year
		$expire+=time();
		
		/* get caching filename */
		$cacheFile = $this->cachePath.DS.$strKey.'.html';
		if ($this->cacheEnabled)
		{
			if(@file_put_contents($cacheFile,$strValue,LOCK_EX)!==false)
			{
				@chmod($cacheFile,0777);
				return @touch($cacheFile,$expire);
			}
			else
				return false;
		}
		else {
			return false;
		}
	}

	public function clearCache($strKey='')
	{
		/* get caching filename */
		if ($strKey)
		{
			$cacheFile = $this->cachePath.DS.$strKey.'.html';
			@unlink($cacheFile);
		}
		else {
			PfBase::emptyDir($this->cachePath);
		}
		return true;
	}
}
