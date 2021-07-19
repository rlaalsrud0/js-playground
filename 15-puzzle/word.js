var word1 = document.getElementById('word1');
var word2 = document.getElementById('word2');
var check = document.getElementById('check');

var words = 'apple,linux,javascript,tutorial'.split(',');

var game = {};
game.choice = function(){
    var idx = Math.floor(Math.random() * words.length);
    return words[idx];
};
var answer = game.choice();
word1.innerHTML = answer;

game.word = answer.split('');
game.btns = [];

game.updateDisplay = function(){
    if(answer === game.word.join('')){
        check.innerHTML = '일치합니다.';
    }else{
        check.innerHTML = '일치하지 않습니다.';
    }
};

for(var i = 0; i < answer.length; i++){
    var btn = document.createElement('button');
    btn.innerHTML = answer[i];
    word2.appendChild(btn);
    game.btns.push(btn);
}

var swap = function(event){
    var temp = [];
    while(game.word.length != 0){
        var s = game.word.pop();
        temp.push(s);
    }
    game.word = temp;
    game.copyBtnText();
    game.updateDisplay();
};

game.copyBtnText = function(){
    for(var i = 0; i < this.word.length; i++){
        this.btns[i].innerHTML = this.word[i];
    }
}

var rshift = function(event){
    var s = game.word.pop();
    game.word.unshift(s);
    game.copyBtnText();
};

var lshift = function(event){
    var s = game.word.shift();
    game.word.push(s);
    game.copyBtnText();
};

var toggle = Math.floor(Math.random() * 2) === 0;

if(toggle){
    swap();
}

var n = Math.floor(Math.random() * answer.length);

for(var i = 0; i < n; i++){
    rshift();
}