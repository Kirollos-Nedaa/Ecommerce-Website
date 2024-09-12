//......................This is for a 15 second timer......................//
// Defining the constants
(function () {
  const second = 1000;
  const minute = 60 * second
  const hour = 60 * minute
  const day = hour * 24

  // Set countdown duration to 15 seconds + 2 for load time
  const countDownTime = 12 * second; //EX: if i want 15 then it will be 17

  const countDown = new Date().getTime() + countDownTime;

  const x = setInterval(function() {
    const now = new Date().getTime();
    const distance = countDown - now;

    // Calculate time left in seconds ,minutes ,hours ,days
    const seconds = Math.floor((distance % (minute)) / second);
    const minutes = Math.floor((distance % (hour)) / (minute));
    const hours = Math.floor((distance % (day)) / (hour));
    const days = Math.floor(distance / (day));


    document.getElementById("seconds").innerText = seconds;
    document.getElementById("minutes").innerText = minutes;
    document.getElementById("hours").innerText = hours;
    document.getElementById("days").innerText = days;

    // Do something later when date is reached
    if (distance < 0) {
      clearInterval(x);
      document.getElementById("headline").innerText = "Thanks For Your Patience!";
      document.getElementById("countdown").style.display = "none";
      document.getElementById("content").style.display = "block";
    }
  }, 1000);
}());