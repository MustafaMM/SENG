import java.awt.BorderLayout;
import java.awt.EventQueue;

import javax.swing.JFrame;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;
import javax.swing.JLabel;
import java.awt.Font;
import javax.swing.JRadioButton;
import java.awt.Color;
import javax.swing.JTextField;
import javax.swing.JButton;

public class SignUp extends JFrame {

	private JPanel contentPane;
	private JTextField usernameField;
	private JTextField passwordField;
	private JTextField confirmField;

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		EventQueue.invokeLater(new Runnable() {
			public void run() {
				try {
					SignUp frame = new SignUp();
					frame.setVisible(true);
				} catch (Exception e) {
					e.printStackTrace();
				}
			}
		});
	}

	/**
	 * Create the frame.
	 */
	public SignUp() {
		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		setBounds(100, 100, 640, 480);
		contentPane = new JPanel();
		contentPane.setBackground(Color.RED);
		contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));
		setContentPane(contentPane);
		contentPane.setLayout(null);
		
		JLabel roleLabel = new JLabel("Please select your role");
		roleLabel.setFont(new Font("Times New Roman", Font.PLAIN, 18));
		roleLabel.setBounds(223, 32, 168, 20);
		contentPane.add(roleLabel);
		
		JRadioButton rdbtnEditor = new JRadioButton("Editor");
		rdbtnEditor.setBackground(Color.RED);
		rdbtnEditor.setBounds(24, 67, 155, 29);
		contentPane.add(rdbtnEditor);
		
		JRadioButton rdbtnReviewer = new JRadioButton("Reviewer");
		rdbtnReviewer.setBackground(Color.RED);
		rdbtnReviewer.setBounds(223, 64, 155, 29);
		contentPane.add(rdbtnReviewer);
		
		JRadioButton rdbtnPublisher = new JRadioButton("Publisher");
		rdbtnPublisher.setBackground(Color.RED);
		rdbtnPublisher.setBounds(435, 67, 155, 29);
		contentPane.add(rdbtnPublisher);
		
		JLabel usernameLabel = new JLabel("Enter a Username");
		usernameLabel.setBounds(72, 178, 126, 20);
		contentPane.add(usernameLabel);
		
		usernameField = new JTextField();
		usernameField.setBounds(232, 175, 146, 26);
		contentPane.add(usernameField);
		usernameField.setColumns(10);
		//gettext
		
		JLabel passwordLabel = new JLabel("Enter a Password");
		passwordLabel.setBounds(72, 220, 126, 20);
		contentPane.add(passwordLabel);
		
		passwordField = new JTextField();
		passwordField.setBounds(232, 217, 146, 26);
		contentPane.add(passwordField);
		passwordField.setColumns(10);
		//get text
		
		JLabel confirmLabel = new JLabel("Confirm your password");
		confirmLabel.setBounds(24, 262, 169, 20);
		contentPane.add(confirmLabel);
		
		confirmField = new JTextField();
		confirmField.setBounds(232, 259, 146, 26);
		contentPane.add(confirmField);
		confirmField.setColumns(10);
		//get text
		
		JButton btnSignUp = new JButton("Sign Up");
		btnSignUp.setBounds(434, 216, 115, 29);
		contentPane.add(btnSignUp);
		/*first check if desired username exists, then check if gettext
		from password and confirm fields match
		then, check what role was selected
		add to hash map of users for that role
		upon button press if the previous conditions hold*/
		
		JLabel alreadyLabel = new JLabel("Already have an account?");
		alreadyLabel.setBounds(138, 358, 187, 20);
		contentPane.add(alreadyLabel);
		
		JLabel lblLogInHere = new JLabel("Log in here");
		lblLogInHere.setForeground(Color.BLUE);
		lblLogInHere.setFont(new Font("Times New Roman", Font.PLAIN, 18));
		lblLogInHere.setBounds(341, 358, 99, 20);
		contentPane.add(lblLogInHere);
		//go to login screen upon button press
		
		JLabel dontMatchLabel = new JLabel("Passwords do not match");
		dontMatchLabel.setEnabled(false);
		dontMatchLabel.setBounds(223, 301, 173, 20);
		contentPane.add(dontMatchLabel);
		//enable if passwords from both fields arent the same
		
	}
}
