
/**
 * register a new account - register with firebase and cometchat.
 * @param {*} object - user's information that will be used to register.
 */
function registerNewAccount({email, password, confirmPassword}) {
  if (validateNewAccount({email, password, confirmPassword})) {
    // show loading indicator.
    showLoading();
    // get user avatar.
    const userAvatar = generateAvatar();
    // create new user's uuid.
    const userUuid = uuid.v4(); 
    // call firebase and cometchat service to register a new account.
    auth.createUserWithEmailAndPassword(email, password).then((userCrendentials) => {
      if (userCrendentials) {
        // call firebase real time database to insert a new user.
        realTimeDb.ref(`users/${userUuid}`).set({
          id: userUuid,
          email,
          avatar: userAvatar
        }).then(() => {
          alert(`${userCrendentials.user.email} was created successfully! Please sign in with your created account`);
          // call cometchat service to register a new account.
          const user = new CometChatWidget.CometChat.User(userUuid);
          user.setName(email);
          user.setAvatar(userAvatar);
          CometChatWidget.init({
            "appID": `${config.CometChatAppId}`,
            "appRegion": `${config.CometChatRegion}`,
            "authKey": `${config.CometChatAuthKey}`
          }).then(response => {
            CometChatWidget.createOrUpdateUser(user).then(user => {
              hideLoading();
            } ,error => {
              hideLoading();
            });
            hideSignUp();
          }, error => {
            //Check the reason for error and take appropriate action.
          });
        });
      }
    }).catch((error) => {
      hideLoading();
      alert(`Cannot create your account, ${email} might be existed, please try again!`);
    }); 
  }
var loginBtn = "";
  loginBtn.addEventListener('click', function() {
    // show loading indicator.
    showLoading();
    // get input user's credentials.
    const email = emailLoginInputElement ? emailLoginInputElement.value : null;
    const password = passwordLoginInputElement ? passwordLoginInputElement.value : null;
    if(isUserCredentialsValid({email, password})) {
      // if the user's credentials are valid, call Firebase authentication service.
      auth.signInWithEmailAndPassword(email, password).then((userCredential) => {
        const userEmail = userCredential.user.email;
        realTimeDb.ref().child('users').orderByChild('email').equalTo(userEmail).on("value", function(snapshot) {
          const val = snapshot.val();
          if (val) {
            const keys = Object.keys(val);
            const user = val[keys[0]];
            if (user && user.id) {
              CometChatWidget.init({
                "appID": `${config.CometChatAppId}`,
                "appRegion": `${config.CometChatRegion}`,
                "authKey": `${config.CometChatAuthKey}`
              }).then(response => {
                CometChatWidget.login({uid: user.id}).then((loggedInUser) => {
                  // User loged in successfully.
                  // hide loading.
                  hideLoading();
                  // redirect to home page.
                  window.location.href = '/';
                });
              }, error => {
                //Check the reason for error and take appropriate action.
              });
            } else { 
              // hide loading indicator.
              hideLoading();
              alert(`Your user's name or password is not correct`);
            }
          }
        });
      })
      .catch((error) => {      
        // hide loading indicator.
        hideLoading();
        alert(`Your user's name or password is not correct`);
      });
    } else { 
      // hide loading indicator.
      hideLoading();
      alert(`Your user's name or password is not correct`);
    }
  });
}