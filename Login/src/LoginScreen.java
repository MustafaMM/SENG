import java.awt.BorderLayout;
import java.awt.EventQueue;

import javax.swing.JFrame;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;
import javax.swing.JLabel;
import java.awt.Font;
import javax.swing.JList;
import javax.swing.JRadioButton;
import java.awt.Color;
import javax.swing.JTextField;
import javax.swing.JPasswordField;
import javax.swing.JButton;

public class LoginScreen extends JFrame {

	private JPanel contentPane;
	private JTextField usernameField;
	private JPasswordField passwordField;

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		EventQueue.invokeLater(new Runnable() {
			public void run() {
				try {
					LoginScreen frame = new LoginScreen();
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
	public LoginScreen() {
		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		setBounds(100, 100, 640, 480);
		contentPane = new JPanel();
		contentPane.setBackground(Color.BLUE);
		contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));
		setContentPane(contentPane);
		contentPane.setLayout(null);
		
		JLabel welcomeLabel = new JLabel("Welcome to the Paper Submission System");
		welcomeLabel.setBounds(15, 0, 588, 39);
		welcomeLabel.setFont(new Font("Times New Roman", Font.BOLD, 33));
		contentPane.add(welcomeLabel);
		
		JLabel roleLabel = new JLabel("Please select your role:");
		roleLabel.setFont(new Font("Times New Roman", Font.PLAIN, 20));
		roleLabel.setBounds(88, 81, 191, 20);
		contentPane.add(roleLabel);
		
		JRadioButton rdbtnReviewer = new JRadioButton("Reviewer");
		rdbtnReviewer.setBackground(Color.BLUE);
		rdbtnReviewer.setBounds(124, 128, 155, 29);
		contentPane.add(rdbtnReviewer);
		
		JRadioButton rdbtnEditor = new JRadioButton("Editor");
		rdbtnEditor.setBackground(Color.BLUE);
		rdbtnEditor.setBounds(124, 165, 155, 29);
		contentPane.add(rdbtnEditor);
		
		JRadioButton rdbtnPublisher = new JRadioButton("Publisher");
		rdbtnPublisher.setBackground(Color.BLUE);
		rdbtnPublisher.setBounds(124, 202, 155, 29);
		contentPane.add(rdbtnPublisher);
		
		usernameField = new JTextField();
		usernameField.setBounds(222, 284, 146, 26);
		contentPane.add(usernameField);
		usernameField.setColumns(10);
		
		passwordField = new JPasswordField();
		passwordField.setBounds(222, 340, 146, 26);
		contentPane.add(passwordField);
		
		JLabel usernameLabel = new JLabel("Username:");
		usernameLabel.setFont(new Font("Times New Roman", Font.PLAIN, 18));
		usernameLabel.setBounds(118, 287, 89, 20);
		contentPane.add(usernameLabel);
		
		JLabel lblPassword = new JLabel("Password:");
		lblPassword.setFont(new Font("Times New Roman", Font.PLAIN, 18));
		lblPassword.setBounds(118, 343, 89, 20);
		contentPane.add(lblPassword);
		
		JButton btnLogin = new JButton("Login");
		btnLogin.setBounds(402, 314, 115, 29);
		contentPane.add(btnLogin);
		
		JLabel memberLabel = new JLabel("Not a member?");
		memberLabel.setFont(new Font("Times New Roman", Font.PLAIN, 18));
		memberLabel.setBounds(416, 82, 121, 20);
		contentPane.add(memberLabel);
		
		JLabel signupLabel = new JLabel("Sign up here!");
		signupLabel.setFont(new Font("Times New Roman", Font.PLAIN, 18));
		signupLabel.setBounds(426, 106, 111, 20);
		contentPane.add(signupLabel);
		
		JButton signupButton = new JButton("Sign up");
		signupButton.setBounds(416, 142, 115, 29);
		contentPane.add(signupButton);
		
		JLabel incorrectLabel = new JLabel("Incorrect username/password");
		incorrectLabel.setEnabled(false);
		incorrectLabel.setForeground(Color.RED);
		incorrectLabel.setFont(new Font("Times New Roman", Font.PLAIN, 20));
		incorrectLabel.setBounds(177, 248, 251, 20);
		contentPane.add(incorrectLabel);
		//if incorrect password{
		//incorrectLabel.setEnabled(true);}
	}
}
