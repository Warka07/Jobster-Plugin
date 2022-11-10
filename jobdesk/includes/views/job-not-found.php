<style>
  @import url('https://fonts.googleapis.com/css?family=Abril+Fatface');

  body {
    font-family: 'Abril Fatface', cursive;
    min-height: 100vh;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -webkit-flex-direction: column;
    -ms-flex-direction: column;
    flex-direction: column;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
  }

  .eyes {
    -webkit-animation: move 2s forwards infinite;
    animation: move 2s forwards infinite;
  }

  @-webkit-keyframes move {
    0% {
      -webkit-transform: translateX(0%);
    }

    20% {
      -webkit-transform: translate(4px, -4px);
    }

    40% {
      -webkit-transform: translate(6px, -4px);
    }

    60% {
      -webkit-transform: translate(12px, 0px);
    }

    80% {
      -webkit-transform: translate(6px, 6px);
    }

    100% {
      -webkit-transform: none;
    }
  }

  @keyframes move {
    0% {
      transform: translateX(0%);
    }

    20% {
      transform: translate(4px, -4px);
    }

    40% {
      transform: translate(6px, -4px);
    }

    60% {
      transform: translate(12px, 0px);
    }

    80% {
      transform: translate(6px, 6px);
    }

    100% {
      transform: none;
    }
  }

  div:before,
  div:after {
    content: "4";
    font-size: 200px;
  }

  p {
    text-align: center;
    margin-top: -40px;
    margin-left: 25px;
    font-size: 55px;
  }

  a {
    text-decoration: none;
    color: #6495ED;
  }

  a:hover {
    padding: 20px;
    background: #6495ED;
    color: black;
    border-radius: 50%;
    box-shadow: 10px 10px 5px #888888;
  }
</style>

<div>
  <svg width="225px" height="224px" viewBox="0 0 225 224" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <image id="Unknown" stroke="none" fill="none" x="0" y="0" width="225" height="224" xlink:href="data:image/png;base64,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"></image>
    <path class="eyes" fill="#6495ED" d="M110.798 67.246c0 6.211 4.353 10.965 9.726 10.965 5.371 0 9.723-4.754 9.723-10.965 0-15.276-19.449-15.276-19.449 0zM55.799 60.246c0 6.211 4.353 10.965 9.726 10.965 5.371 0 9.723-4.754 9.723-10.965 0-15.276-19.449-15.276-19.449 0z" />
  </svg>
</div>
