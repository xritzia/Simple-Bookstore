<!-- Upload a Book Form -->
<div class="bookform">
  <h2 class="underline2">Book Details</h2><br>
  <div id="error"></div>
  <form id="bookform" method="POST" action="book_upload.php" enctype="multipart/form-data">
    <p>Book Title:<input id="name" class="booktitle" type="text" name="name"></p>
    <p>Book Cover:<input id="img" type="file" name="img" accept="image/*"></p>
    <p>Author:<input id="author" class="bookbox1" type="text" name="author"></p>
    <p>ISBN:<input id="isbn" class="bookbox"type="number" name="isbn" ></p>
    <p>Price:<input id="price" class="bookbox" type="number" name="price"></p><br>
    <p>Description:</p>
    <textarea id="descri" class="txtarea" name="description" cols="100" rows="5"></textarea>
    <p id="descri-counter"></p><br><br>
    <input id="postbook" class="uploadbtn btnhov" type="submit" name="post" value="Upload Book">
    <button class="cancelbtn btnhovcl" type="button" onClick="location.href='index.php'" name="cancel">Cancel</button>
  </form>
</div>

<!-- Javascript for counter functionality -->
<script>
  const descriTextarea = document.getElementById("descri");
  const descriCharCount = document.getElementById("descri-counter");

  descriTextarea.addEventListener("input", function() {
    const maxLength = 500;
    let currentLength = descriTextarea.value.length;

    if (currentLength > maxLength) {
      descriTextarea.value = descriTextarea.value.slice(0, maxLength);
      currentLength = maxLength;
    }

    descriCharCount.textContent = currentLength + "/" + maxLength;
  });
</script>