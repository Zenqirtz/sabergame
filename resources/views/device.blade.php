<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Saber Game Rental PS Malang</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
    rel="stylesheet"
  />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  @vite('resources/css/app.css')
</head>
<body>
    @include('nav')
  <main class="container">
    <h2 class="section-title">Available Device</h2>

    <!-- PS4 Section -->
    <section class="device-section">
      <div class="device-image">
        <img src="{{ asset('images/PS4.png') }}" alt="PS4" />
      </div>
      <div class="device-controls">
        <div class="numbers">
          <button>1</button>
          <button>2</button>
          <button>3</button>
          <button>4</button>
          <button>5</button>
          <button class="active">6</button>
          <button>8</button>
          <button>9</button>
          <button>10</button>
          <button>11</button>
          <button class="active">12</button>
          <button>13</button>
          <button>14</button>
          <button>15</button>
          <button>16</button>
          <button>17</button>
        </div>
        <div class="availability-buttons">
          <button class="not-available">Not Available</button>
          <button class="available">Available</button>
        </div>
      </div>
    </section>

    <!-- PS3 Section -->
    <section class="device-section">
      <div class="device-image">
        <img src="{{ asset('images/PS3.png') }}" alt="PS3" />
      </div>
      <div class="device-controls">
      <div class="device-controls">
        <div class="numbers">
          <button class="active">1</button>
          <button class="active">2</button>
          <button>3</button>
          <button>4</button>
          <button>5</button>
          <button>6</button>
          <button>8</button>
          <button>9</button>
          <button>10</button>
          <button>11</button>
          <button>12</button>
          <button>13</button>
          <button>14</button>
          <button>15</button>
          <button>16</button>
          <button>17</button>
        </div>
        <div class="availability-buttons">
          <button class="not-available">Not Available</button>
          <button class="available">Available</button>
        </div>
      </div>
    </section>
  </main>
      </div>
    </div>
    @include('footer')
</body>
</html>
