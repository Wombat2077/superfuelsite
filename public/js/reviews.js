document.getElementById('reviewForm').addEventListener('submit', function(event) {
  event.preventDefault();
  
  var name = document.getElementById('name').value;
  var review = document.getElementById('review').value;
  
  var reviewElement = document.createElement('div');
  reviewElement.classList.add('review');
  reviewElement.innerHTML = '<p><strong>' + name + '</strong></p><p>' + review + '</p>';
  
  document.getElementById('reviews').appendChild(reviewElement);
  
  document.getElementById('name').value = '';
  document.getElementById('review').value = '';
});
