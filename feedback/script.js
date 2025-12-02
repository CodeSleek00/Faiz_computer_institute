// script.js
document.addEventListener('DOMContentLoaded', ()=>{
const form = document.getElementById('feedbackForm');
const msg = document.getElementById('msg');
const feedbackList = document.getElementById('feedbackList');


async function loadFeedbacks(){
feedbackList.innerHTML = 'Loading...';
try{
const res = await fetch('fetch_feedbacks.php');
const data = await res.json();
if (data.status !== 'success') throw new Error(data.message || 'Failed');
const rows = data.data;
if (!rows.length) { feedbackList.innerHTML = '<p>No feedback yet. Be the first!</p>'; return; }


feedbackList.innerHTML = '';
rows.forEach(r=>{
const div = document.createElement('div');
div.className = 'feedback-item';
div.innerHTML = `
<div class="feedback-meta">
<div class="feedback-name">${escapeHtml(r.student_name)}</div>
<div class="feedback-rating">${renderStars(r.rating)}</div>
</div>
<div class="feedback-comment">${escapeHtml(r.comment)}</div>
<div class="feedback-time">${new Date(r.created_at).toLocaleString()}</div>
`;
feedbackList.appendChild(div);
});
} catch(err){
feedbackList.innerHTML = '<p>Error loading feedbacks.</p>';
console.error(err);
}
}


form.addEventListener('submit', async (e)=>{
e.preventDefault();
msg.textContent = '';
const formData = new FormData(form);


try{
const res = await fetch('submit_feedback.php', { method: 'POST', body: formData });
const data = await res.json();
if (data.status === 'success'){
msg.style.color = 'green';
msg.textContent = data.message || 'Submitted';
form.reset();
loadFeedbacks();
} else {
msg.style.color = 'red';
if (data.errors) msg.textContent = data.errors.join(' ');
else msg.textContent = data.message || 'Error';
}
} catch(err){
msg.style.color = 'red';
msg.textContent = 'Network or server error.';
console.error(err);
}
});


function renderStars(n){
let out = '';
});