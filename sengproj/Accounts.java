import java.util.HashMap;

public class Accounts {
	
	private static HashMap<String, Researcher> researchAccounts = new HashMap<String, Researcher>();
	private static HashMap<String, Reviewer> reviewerAccounts = new HashMap<String, Reviewer>();
	private static HashMap<String, Editor> editorAccounts = new HashMap<String, Editor>();
	
	private static int idCounter = 0;
	
	public void addResearcher(String email, Researcher account) {
		
		researchAccounts.put(email, account);
		idCounter++;
	}
	
	public HashMap<String, Researcher> getResearchAccounts() {
		return researchAccounts;
	}


	public HashMap<String, Reviewer> getReviewerAccounts() {
		return reviewerAccounts;
	}


	public HashMap<String, Editor> getEditorAccounts() {
		return editorAccounts;
	}

	public void addReviewer(String email, Reviewer account) {
		
		reviewerAccounts.put(email, account);
		idCounter++;
	}
	
	public void addEditor(String email, Editor account) {
		
		editorAccounts.put(email, account);
		idCounter++;
	}
	
	public Researcher returnResearcher(String email) {
		return researchAccounts.get(email);
	}
	
	public Reviewer returnReviewer(String email) {
		return reviewerAccounts.get(email);
	}
	
	public Editor returnEditor(String email) {
		return editorAccounts.get(email);
	}
	

	public int returnIDCounter() {
		return idCounter;
	}
	
	public boolean checkExistingEmail(String email) {
		for (String i : researchAccounts.keySet()) {
			if (email.equals(returnResearcher(i).getEmail())) {
				return true;
			}	
		}
		
		for (String i : reviewerAccounts.keySet()) {
			if (email.equals(returnReviewer(i).getEmail())) {
				return true;
			}	
		}
		
		for (String i : editorAccounts.keySet()) {
			if (email.equals(returnEditor(i).getEmail())) {
				return true;
			}	
		}	
		return false;
	}
	
	public static String checkAccount (Researcher account1, Reviewer account2, Editor account3) {
		if (account1 != null) {
			return "Researcher";
		} else if (account2 != null) {
			return "Reviewer";
		} else {
			return "Editor";
		}
	}
	
	public String returnAccount(String email) {
		Researcher account1 = returnResearcher(email);
		Reviewer account2 = returnReviewer(email);
		Editor account3 = returnEditor(email);
		
		if(account1 != null) {
			return "Researcher";
					
		} else if (account2 != null) {
			return "Reviewer";
		} else  {
			return "Editor";
		}
	
	}
	

	

}
