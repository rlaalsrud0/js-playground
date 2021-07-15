var input = {'array' : []};

input.getInput = function(){
    return this.array.join("");
}

var output = {};
output.text = document.getElementById('output');

var clickNumbers = function(event){
    var str = event.target.innerHTML;
    console.log(str);
    switch(str){
        case 'BS' :
        input.array.pop();
        break;
        case '+' :
        case '-' :
        case '*' :
        case '/' :
        input.array.push(' ' + str + ' ');
        break;
        default :
        input.array.push(str);
    }
    if(input.array.length === 0){
        output.text.innerHTML = "Empty";
    }else{
        output.text.innerHTML = input.getInput();
    }
}
var showResult = function(event){
    console.log("click others");
    console.log(event.target.innerHTML);
}