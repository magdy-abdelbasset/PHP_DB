<?php 
namespace Src;
use \Src\Traits\Sql;

// string builder
class Grammar{
    use Sql;
    private string $word;
    private string $between_key_value= " = ";
    private string $betweenRaw=' , ' ;
    private string $keyBetween = '`';
    private string $valueBetween="\"";
    private string $valueBetweenNotStr = '';
    private string $multiKeysOpen = '(';
    private string $multiKeysClose = ')';
    private string $between_keys_values = ' VALUES ';
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
    public function arrayConnectDuplicate(array $array ,$replaceIt=null,$betweenValues = " VALUES "
    ,string $betweenBefore= '`' ,string $betweenAfter='`',string $betweenBeforeFirst = '(',
    string $betweenAfterFirst = ')',string $betweenBeforeSecond = '(',
    string $betweenAfterSecond = ')',string $betweenWord = ' , ',
    string $betweenBefore2=':',string $betweenAfter2='')
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
    
    public function __call($name, $arguments)
    {
        if(array_key_exists($name,$this->StarterWord) || $this->word !=''){
            $this->word .= $this->StarterWord[$name];
            return $this;
        }
        $error = $this->word =="" ? "word is't not empty":"no function $name";
        throw $error;
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
    private function substrLeft($betweenRaw)
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
        return substr($this->word,0 , $ofSet) ;
        
    }

}