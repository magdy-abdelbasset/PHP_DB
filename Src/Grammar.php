<?php 
namespace Src;
// string builder
class Grammar{
    private string $word;
    private string $between_key_value= " = ";
    private string $betweenRaw=' , ' ;
    private string $keyBetween = '`';
    private string $valueBetween="\"";
    private string $valueBetweenNotStr = '';
    private string $multiKeysOpen = '(';
    private string $multiKeysClose = ')';
    // set vairablels construct
    public function __construct(string $word='',string $between_key_value= " = " ,string $betweenRaw=' , ' 
        ,string $keyBetween = '`', string $valueBetween="\"",string $valueBetweenNotStr='')
    {
        $this->$between_key_value = $between_key_value;
        $this->$betweenRaw = $betweenRaw;
        $this->$keyBetween = $keyBetween;
        $this->$valueBetween = $valueBetween;
        $this->$valueBetween = $valueBetween;
        $this->word = $word;
    }
    // build string from array and but some strings between and 
    // return str 
    public function arrayConnect(array $array)
    {
        foreach ($array as $key=>$value)
        {     
            $this->word .= $this->keyBetween . $key . $this->keyBetween . $this->between_key_value . $this->valueBetween($value) . $this->betweenRaw;
        }
        $this->word = substr($this->word,0 , 0-strlen($this->betweenRaw));   
        return $this->word;
    }
    public function arrayConnectMulti(array $keys,array $values
    ,string $multiKeysOpen = $this->multiKeysOpen , string $multiKeysClose = $this->multiKeysClose)
    {
        $this->word .= $multiKeysOpen ;
        $this->word .= $this->arrayBetween($keys);
        $this->word .= $multiKeysClose;
        return $this->word;
    }
    // but keys array between str and return str
    public function arrayBetween(array $values,$between_before = $this->betweenRaw , $between_after = $between_before)
    {
        $word = '';
        foreach ($values as $value)
        {     
            $word .= $this->valueBetween($value , $between_before,$between_after);
        }
        return $word;
    }
    // return difrence values which type change
    private function valueBetween($v,string $betweenBefore= $this->valueBetween ,string $betweenAfter=$betweenBefore)
    {
        if(is_string($v))
        {
            return $this->valueBetween . $v . $this->valueBetween;            
        }
        return $this->valueBetweenNotStr . $v . $this->valueBetweenNotStr;  
    }

}