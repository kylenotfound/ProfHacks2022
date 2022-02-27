checkBox = document.getElementById('remoteBox').addEventListener('click', event => {
	if(event.target.checked) {
		document.getElementById('address-info').setAttribute('hidden', 'hidden');
	} else {
    document.getElementById('address-info').removeAttribute('hidden', 'hidden');
  }
});

/**
 * Take an HTML Input field (textfield, textarea etc) and a char count ex 150
 * And display the how many chars the user can still type, as they type.
 */
 function displayCharsLeftDesc(element, countFrom) {
  var textInput = element.value.length;
  var charactersLeft = countFrom - textInput;
  document.getElementById('charsLeftDesc').innerHTML = "Characters left: " + charactersLeft;
}

function displayCharsLeftNotes(element, countFrom) {
  var textInput = element.value.length;
  var charactersLeft = countFrom - textInput;
  document.getElementById('charsLeftNotes').innerHTML = "Characters left: " + charactersLeft;
}

function displayCharsLeft(element, countFrom) {
  var textInput = element.value.length;
  var charactersLeft = countFrom - textInput;
  document.getElementById('charsLeft').innerHTML = "Characters left: " + charactersLeft;
}