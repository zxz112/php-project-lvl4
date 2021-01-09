'use strict';

const formDay = document.querySelector('#submit_day');

// formDay.addEventListener('submit', (e) => {
//     e.preventDefault();
//     const data = new FormData(formDay);
//     const checkbox = formDay.querySelector('[type="checkbox"]');
//     if (checkbox.checked) {
//         data.append('gym', 'on');
//     } else {
//         data.append('gym', 'off');
//     }
//     fetch('/tms/addday', {
//         method: 'POST',
//         body: data
//     }).fetch((data) => console.log(data));
// });
