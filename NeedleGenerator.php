<?php



//http://coliru.stacked-crooked.com/a/b280c1064ff45407

//http://coliru.stacked-crooked.com/a/c5675de62ca18e80


$depend0 = "#define DEPEND(CLASSNAME)  public: CLASSNAME() {} static CLASSNAME & Get() { static CLASSNAME object; return object; } private: \n";
$depend0 .= "#define DEPEND0(CLASSNAME)  public: CLASSNAME() {} static CLASSNAME & Get() { static CLASSNAME object; return object; } private: \n";
echo $depend0;
$beginMacro = "#define DEPEND(CLASSNAME";
$fields = ") private: ";
$constructorBegin = "public: CLASSNAME(";
$constructorAssign = ") : ";
$constructorEnd = " {} ";
$get = "static CLASSNAME & Get() { static CLASSNAME object(";
$getEnd = "); return object; } private:";
for($i = 1; $i < 3; $i++){
  //$str_replace($beginMacro, "{{NUMBER}}", $i);
  $beginMacro .= ", DEP$i";
  $fields .= "I ## DEP".$i." * this ## DEP".$i."; ";
	
	if($i > 1){
		  $constructorBegin .= ", ";
	}
  $constructorBegin .= "I ## DEP${i} * this ## DEP${i}";

		if($i > 1){
		  $constructorAssign .= ", ";
	}
$constructorAssign .= "this ## DEP${i}(this ## DEP${i})";
	if($i > 1){
		  $get .= ", ";
	}
	$get .= "&( DEP${i} ::Get())";
	
	echo str_replace("DEPEND",  "DEPEND${i}", $beginMacro).$fields.$constructorBegin.$constructorAssign.$constructorEnd.$get.$getEnd."\n";
}




#define DEPEND2(CLASSNAME, DEP1, DEP2) private: DEP1 this ## DEP1; DEP2 this ## DEP2; public: CLASSNAME(DEP1 this ## DEP1, DEP2 this ## DEP2) : this ## DEP1(this ## DEP1), this ## DEP2(this ## DEP2) {} static CLASSNAME Get() { static CLASSNAME object(DEP1::Get(), DEP2::Get()); return object; } 
