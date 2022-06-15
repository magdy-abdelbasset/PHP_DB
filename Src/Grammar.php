<?php 
namespace Src;

use Exception;

// string builder
class Grammar{
    private string $word;
    private string $betweenRaw=' , ' ;
    private string $valueBetweenNotStr = '';
    // set vairablels construct
    public function __construct(string $word=''
        )
    {
        $this->word = $word;

    }
    public function setWord($word)
    {
        $this->word = $word ;
        return $this;
    }
    public function add($word,string $between='`',bool $numNotBetween = true,bool $before = false)
    {
        if(!is_string($word) && $numNotBetween){
            $between = '';
        }
        if($before){
            $this->word = $between.$word.$between . $this->word ;

        }else{
            $this->word .= $between.$word.$between ;
        }
        return $this;
    }
    
    public function connectWord($word)
    {
        $this->word .= $word ;
        return $this;
    }
    public function getWord()
    {
        return $this->word;
    }
    // build string from array and but some strings between and 
    // return str 
    public function arrayConnect(array $array ,$betweenRaw = " , "
    ,string $betweenBefore= '`' ,string $betweenAfter='`',
    string $betweenValueBefore='"',string $betweenValueAfter='"')
    {
        foreach ($array as $key=>$value)
        {     
            $this->word .= $this->valueBetween($key,$betweenBefore,$betweenAfter);
            $this->word .=   $this->valueBetween($value,$betweenValueBefore,$betweenValueAfter) ;
            $this->word .= $betweenRaw;
        }
        $this->word = $this->substrLeft($this->betweenRaw);   
        return $this;
    }
    
    // build string from first array , second array ,
    // but some strings between and 
    // return str 
    public function arrayConnectMulti(
        array $keys
        ,array $values
        ,string $between_keys_values = ' VALUES '
        ,string $betweenValueBefore= '"'
        ,string $betweenValueAfter= '"'
        ,string $betweenKeyBefore= '`'
        ,string $betweenKeyAfter= '`'
        ,string $betweenValueAndKeyAfterSubLest= ' , '
        ,string $multiKeysOpen = '(' 
        ,string $multiKeysClose = ')'
        ,string $multiValuesOpen ='(' 
        ,string $multiValuesClose = ')')
    {
        $this->word .= $multiKeysOpen ;
        $this->word .= $this->arrayBetween($keys,$betweenKeyBefore,$betweenKeyAfter.$betweenValueAndKeyAfterSubLest);
        $this->word = $this->substrLeft($betweenValueAndKeyAfterSubLest);
        $this->word .= $multiKeysClose;
        $this->word .= $between_keys_values;
        $this->word .= $multiValuesOpen;
        $this->word .= $this->arrayBetween($values,$betweenValueBefore,$betweenValueAfter.$betweenValueAndKeyAfterSubLest);
        $this->word = $this->substrLeft($betweenValueAndKeyAfterSubLest);
        $this->word .= $multiValuesClose;

        return $this;
    }
    // connect , duplicate array and return as string but some words between values
    public function arrayConnectDuplicate(
    array $array ,
    $replaceIt=null,
    string $betweenValues = " VALUES ",
    string $betweenBefore= '`' ,
    string $betweenAfter='`',
    string $betweenBeforeFirst = '(',
    string $betweenAfterFirst = ')',
    string $betweenBeforeSecond = '(',
    string $betweenAfterSecond = ')',
    string $betweenWord = ' , ',
    string $betweenBefore2=':',
    string $betweenAfter2='')
    {
        $this->word .= $betweenBeforeFirst;
        $this->word .= $this->arrayBetween($array,$betweenBefore,$betweenAfter.$betweenWord);
        $this->word = $this->substrLeft($betweenWord);
        $this->word .= $betweenAfterFirst;
        $this->word .= $betweenValues;
        $this->word .= $betweenBeforeSecond;        
        if($replaceIt){
            $output = array_map(function ($val) use ($replaceIt) { return $replaceIt; }, $array);

        }else{
            $output = $array ;
        }
        $this->word .= $this->arrayBetween($output,$betweenBefore2,$betweenAfter2.$betweenWord);
        $this->word = $this->substrLeft($betweenWord);
        $this->word .= $betweenAfterSecond;
        return $this;
    }
    public function arrayConnectDuplicateKeys(
        array $array ,
        $replaceIt=null,
        string $betweenValues = " VALUES ",
        string $betweenBefore= '`' ,
        string $betweenAfter='`',
        string $betweenBeforeFirst = '(',
        string $betweenAfterFirst = ')',
        string $betweenBeforeSecond = '(',
        string $betweenAfterSecond = ')',
        string $betweenWord = ' , ',
        string $betweenBefore2=':',
        string $betweenAfter2='')
        {
            $this->word .= $betweenBeforeFirst;
            $this->word .= $this->arrayBetweenKey($array,$betweenBefore,$betweenAfter.$betweenWord);
            $this->word = $this->substrLeft($betweenWord);
            $this->word .= $betweenAfterFirst;
            $this->word .= $betweenValues;
            $this->word .= $betweenBeforeSecond;        
            if($replaceIt){
                $output = array_map(function ($val) use ($replaceIt) { return $replaceIt; }, $array);
    
            }else{
                $output = $array ;
            }
            $this->word .= $this->arrayBetweenKey($output,$betweenBefore2,$betweenAfter2.$betweenWord);
            $this->word = $this->substrLeft($betweenWord);
            $this->word .= $betweenAfterSecond;
            return $this;
        }
        public function arrayDuplicateKeys(
            array $array ,
            string $betweenBefore= '`' ,
            string $betweenAfter='`',
            string $betweenWord = ' , ',
            string $betweenBefore2=':',
            string $betweenAfter2='',
            string $betweenKeys = ' = ',bool $before=false)
            {
                foreach ($array as $key=>$v)
                {     
                    $this->word .= $betweenBefore.$key.$betweenAfter.$betweenKeys.$betweenBefore2.$key.$betweenAfter2.$betweenWord;   
                }
                $this->word = $this->substrLeft($betweenWord);
                return $this;
            }
            private function checkBefore(string $syntax,bool $before)
            {
                if($before){
                    $this->word = $syntax .$this->word;
                    return;
                }
                $this->word .= $syntax;


            }
    // call to static word and connect with syntax  
    public function __call($name, $arguments)
    {
        if(array_key_exists($name,STARTER_WORD) ){
            if(isset($arguments[0])){
                $this->word = STARTER_WORD[$name].$this->word;  
            }else{
                $this->word .= STARTER_WORD[$name];
            }
            return $this;
        }
        $error = $this->word =="" ? "word is't not empty":"no function $name";
        throw new Exception($error);

    }
    // but keys array between str and return str
    private function arrayBetween(array $values,string $between_before = '`' ,string $between_after = '`')
    {
        
        $word = '';
        foreach ($values as $value)
        {     
            $word .= $this->valueBetween($value , $between_before,$between_after);
        }
        return $word;
    }
    private function arrayBetweenKey(array $values,string $between_before = '`' ,string $between_after = '`')
    {
        
        $word = '';
        foreach ($values as $key=>$v)
        {     
            $word .= $this->valueBetween($key , $between_before,$between_after);
        }
        return $word;
    }
    
    // value between str1 , str2 and in middle but str
    // chang syntax  
    public function arrayBetweenSub(array $values,string $between_before = '`'
     ,string $between_after = '`',string $subStr=' , ',$replaceIt = null,$before=false)
    {
        $word ='';
        foreach ($values as $value)
        {   
            $v = $replaceIt ?? $value;  
            $word .= $this->valueBetween($v , $between_before,$between_after.$subStr);
        }
        if($before){
            $this->word = $this->substrLeft($subStr,$word).$this->word;
            return $this ;
        }
        $this->word .= $word;
        $this->word = $this->substrLeft($subStr);
        return $this;
    }
    // return difrence values which type change
    private function valueBetween($v,string $betweenBefore= '`' ,string $betweenAfter='`')
    {
        if(is_string($v))
        {
            return $betweenBefore . $v . $betweenAfter;            
        }
        return $this->valueBetweenNotStr . $v . $this->valueBetweenNotStr;  
    }
    // cut string count char between raw 
    private function substrLeft($betweenRaw,$word=null)
    {
        $ofSet = null;
        // length if string
        if(is_string($betweenRaw)){
            $ofSet = 0 - strlen($betweenRaw);   
        }elseif(is_int($betweenRaw)){
            $ofSet = 0- $betweenRaw;
        }
        if(!$ofSet){
            throw "must be integer or string";
        }
        if($word){
            return substr($word,0 , $ofSet) ;
        }  
        return substr($this->word,0 , $ofSet) ;
        
    }

}