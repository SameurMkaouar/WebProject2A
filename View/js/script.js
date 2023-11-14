document.querySelectorAll('.feedback li').forEach(entry => entry.addEventListener('click', e => {
    if(!entry.classList.contains('active')) {
        document.querySelector('.feedback li.active').classList.remove('active');
        entry.classList.add('active');
    }
    e.preventDefault();
}));
/*MOOD*/
function addMood(mood) {
    var moodList = document.getElementById('mood-list');

    // Check if the mood is already in the list
    var existingMoods = Array.from(moodList.children).map(item => item.textContent.toLowerCase());
    if (existingMoods.includes(mood.toLowerCase())) {
        return;
    }

    var listItem = document.createElement('li');
    listItem.textContent = mood;
    moodList.appendChild(listItem);

    // Disable the clicked button
    var moodBtn = document.getElementById(mood.toLowerCase() + 'Btn');
    moodBtn.disabled = true;
    moodBtn.classList.add('selected');
}
/*MOOD*/