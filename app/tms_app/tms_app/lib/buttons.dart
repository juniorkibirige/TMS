class Buttons{
  bool changesMade = false;
  anyChanges() {
    print(changesMade);
    return changesMade;
  }
  makeChanges(bool val) {
    changesMade = val;
  }
  changesSaved() {
    changesMade = false;
  }
}

Buttons buttons = Buttons();