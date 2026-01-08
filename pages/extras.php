<div class="redirect-prompt">
    <h1>IF YOU CAN SEE THIS YOU ARE NOT LOADING THE PAGE CORRECTLY, PLEASE <a href="/">RETURN</a></h1>
</div>

<style>
    .three-grid {
  display: flex;
  flex-wrap: wrap;
  gap: 16px;
  margin-inline: 7.5%;
}

.three-grid > * {
  box-sizing: border-box;
  flex: 0 0 calc((100% - 32px) / 3);
  max-width: calc((100% - 32px) / 3);
}

/* Responsive: stack on narrow viewports */
@media (max-width: 700px) {
  .three-grid > * {
    flex: 0 0 100%;
    max-width: 100%;
  }
}
</style>

<main-element class="welcome">
    <h1>Title</h1>
</main-element>

<div class="three-grid">
    <main-element class="card">
    <p>Color Picker test</p>
<div>
    <input type="color" id="foreground" name="foreground" value="#e66465" />
    <label for="foreground">Color Picker testing</label>
    </div>
    </main-element>
    <main-element class="card">Item 2</main-element>
    <main-element class="card">Item 3</main-element>
    <main-element class="card">Item 4</main-element>
  <!-- additional items wrap to the next row -->
</div>

<!--?php include '../backend/meta/footer.php'; ?>-->