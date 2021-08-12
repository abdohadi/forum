// Triggers an event called "flash" that has a listener in the Flash component
window.flash = (message) => {
  var flashEvent = new CustomEvent("flash", {
    detail: {
      message: message
    }
  });
  
  body.dispatchEvent(flashEvent);
};