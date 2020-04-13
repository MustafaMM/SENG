import java.util.Properties;
import java.util.logging.Level;
import java.util.logging.Logger;

import javax.mail.internet.*;
import javax.mail.*;
import javax.mail.Address;
/*
import javax.mail.Authenticator;
import javax.mail.Message;
import javax.mail.PasswordAuthentication;
import javax.mail.Session;
import javax.mail.Transport;
import javax.mail.internet.InternetAddress;
import javax.mail.internet.MimeMessage;
*/
public class JavaMail {

	public static void sendMail (String recipient, String subject, String text) throws Exception {

		  System.out.println("Sending email");
	      Properties properties = new Properties();

	      properties.put("mail.smtp.auth","true");
	      properties.put("mail.smtp.starttls.enable", "true");
	      properties.put("mail.smtp.host", "smtp.gmail.com");
	      properties.put("mail.smtp.ssl.trust", "smtp.gmail.com");
	      properties.put("mail.smtp.port", "587");

	      String email = "mcgruderj5@gmail.com";
	      String pass = "BurnerAccount9182736455!@#";

	      Session session = Session.getInstance(properties, new Authenticator() {
	    	  @Override
	    	  protected PasswordAuthentication getPasswordAuthentication() {
	    		  return new PasswordAuthentication(email, pass);
	    	  }
	      });

	      Message message = prepareMessage(session, email, recipient, subject, text);

	      Transport.send(message);
	      System.out.println("You have sent the message.");

	}

	private static Message prepareMessage(Session session, String email, String recipient, String subject, String text) {
		try {
			Message message = new MimeMessage(session);
			message.setFrom(new InternetAddress(email));
			message.setRecipient(Message.RecipientType.TO, new InternetAddress(recipient));
			message.setSubject(subject);
			message.setText(text);
			return message;
		} catch (Exception ex) {
			Logger.getLogger(LoginScreen.class.getName()).log(Level.SEVERE, null, ex);
		}

		return null;
	}

	public static String accountCreationString(String name, String faculty, String email) {
		return "Thank you for creating a new account for the paper submission system.\n\nName: " + name + "\n\n" + "Email: " + email + "\n\n" + "Faculty: " + faculty;
	}

	public static String forgotPasswordString(String password) {
		return "Your password has been reset.\n\nNew password: " + password;
	}

	public static void main(String[] args) {
		String subject = "Email subject";
		String message = "Hello there!";
		try {
			sendMail("yuukiyash@gmail.com", subject, message);
		} catch (Exception e1) {
		// TODO Auto-generated catch block
			e1.printStackTrace();
		}
	}

}
