jQuery(function ($) {
  // maker sure there are not messages being displayed
  if ($(".CRM_Contribute_Form_Contribution_Main").length && $("form > .messages").length === 0) {
    $(".crm-submit-buttons").after('<a class="oaf-donation-button oaf-donation-step-reveal" role="button" href="#donation-step-2">Next step</button>');

    var btn = $(".oaf-donation-step-reveal");

    if ( $(".oaf-donation-step-reveal").length > 0 ) {
      // Card info group
      $(".credit_card_info-group").addClass("donation-step donation-step-hidden donation-step-2").attr("id", "donation-step-2");
      // Billing information group
      $(".billing_name_address-group").addClass("donation-step donation-step-hidden donation-step-3").attr("id", "donation-step-3");
      // Form submit button
      $(".crm-submit-buttons").addClass("donation-step donation-step-hidden donation-step-4");

      var step2 = $(".donation-step-2"),
          step3 = $(".donation-step-3"),
          step4 = $(".donation-step-4");

      // reveal the next step
      btn.click(function(event) {
        event.preventDefault();
        if (step2.hasClass("donation-step-hidden")) {
          step2.removeClass("donation-step-hidden");
          btn.attr("href", "#donation-step-3");
          btn.text("Final step");
          ga('send', 'event', 'donation', 'click step 1')
        } else if (!step2.hasClass("donation-step-hidden") && step3.hasClass("donation-step-hidden")) {
          step3.removeClass("donation-step-hidden");
          step4.removeClass("donation-step-hidden");
          btn.remove();
        }
      });
    }
  }
});


// hide other amount field unless wanted
jQuery(function ($) {
  $radio = $("div.price-set-row:last-child input[type='radio']");
  $input = $(".other_amount-section");

  // add class
  $input.addClass("donation-step-hidden");

  // toggle class on hover
  $radio.change(function() {
    if(this.checked) {
      $input.removeClass("donation-step-hidden");
      $(".other_amount-section input").focus();
    } else {
      $input.addClass("donation-step-hidden");
    }
  });
});
