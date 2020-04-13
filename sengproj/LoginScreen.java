import java.awt.EventQueue;


import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JTextField;
import javax.swing.JTextPane;
import javax.swing.ListSelectionModel;
import javax.swing.border.EmptyBorder;
import javax.swing.border.EtchedBorder;
import javax.swing.table.DefaultTableModel;
import javax.swing.JPanel;
import java.awt.Color;
import java.awt.Font;
import javax.swing.JComboBox;
import javax.swing.DefaultComboBoxModel;
import javax.swing.JButton;
import javax.swing.JPasswordField;
import java.awt.Toolkit;
import javax.swing.JDesktopPane;
import java.awt.event.ActionListener;
import java.awt.event.ActionEvent;
import javax.swing.JPopupMenu;
import javax.swing.JTable;

import java.awt.Component;
import java.awt.event.MouseAdapter;
import java.awt.event.MouseEvent;

import java.util.*;
import java.util.logging.Level;
import java.util.logging.Logger;

import javax.mail.*;
import javax.mail.internet.*;

import java.io.File; 

public class LoginScreen {

	private JFrame frmPaperSubmissionSystem, accountCreation, researcherMenu, settings, forgotPassword;
	private JTextField userField;
	private JLabel loginTitle;
	private JPasswordField passwordField;
	protected Accounts accounts = new Accounts();
	private Researcher currentResearch = new Researcher();
	private Reviewer currentReview = new Reviewer();
	private Editor currentEditor = new Editor();
	
	private String emailSubject1 = "Account creation";
	private String emailSubject2 = "Password Reset";
	

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		EventQueue.invokeLater(new Runnable() {
			public void run() {
				try {
					LoginScreen window = new LoginScreen();
					window.frmPaperSubmissionSystem.setVisible(true);
				} catch (Exception e) {
					e.printStackTrace();
				}
			}
		});
	}

	/**
	 * Create the application.
	 */
	public LoginScreen() {
		initialize();
	}

	/**
	 * Initialize the contents of the frame.
	 */
	private void initialize() {
		frmPaperSubmissionSystem = new JFrame();
		frmPaperSubmissionSystem.setIconImage(Toolkit.getDefaultToolkit().getImage("C:\\Users\\Shiina\\Desktop\\CPSC\\Seng300\\src\\unnamed.png"));
		frmPaperSubmissionSystem.setTitle("Paper Submission System");
		frmPaperSubmissionSystem.getContentPane().setBackground(new Color(128, 128, 128));
		frmPaperSubmissionSystem.setBounds(100, 100, 533, 347);
		frmPaperSubmissionSystem.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		frmPaperSubmissionSystem.getContentPane().setLayout(null);
		frmPaperSubmissionSystem.setLocationRelativeTo(null);

		JFrame popup = new JFrame();
		popup.setLocationRelativeTo(null);
		popup.pack();


		JButton createAccount = new JButton("Create account");
		createAccount.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {

				frmPaperSubmissionSystem.dispose();
				accountCreation();
				accountCreation.setVisible(true);

			}
		});

		JButton forgotPass = new JButton("Forgot password?");
		forgotPass.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				frmPaperSubmissionSystem.dispose();
				forgotPassword();
			}
		});
		forgotPass.setBounds(104, 244, 138, 23);
		frmPaperSubmissionSystem.getContentPane().add(forgotPass);
		createAccount.setBounds(287, 244, 129, 23);
		frmPaperSubmissionSystem.getContentPane().add(createAccount);

		JLabel lblNewLabel = new JLabel("Username:");
		lblNewLabel.setFont(new Font("Tahoma", Font.BOLD, 11));
		lblNewLabel.setBounds(129, 97, 69, 14);
		frmPaperSubmissionSystem.getContentPane().add(lblNewLabel);

		JLabel lblPassword = new JLabel("Password:");
		lblPassword.setFont(new Font("Tahoma", Font.BOLD, 11));
		lblPassword.setBounds(129, 135, 69, 14);
		frmPaperSubmissionSystem.getContentPane().add(lblPassword);

		userField = new JTextField();
		userField.setBounds(230, 94, 138, 20);
		frmPaperSubmissionSystem.getContentPane().add(userField);
		userField.setColumns(10);

		passwordField = new JPasswordField();
		passwordField.setBounds(230, 132, 138, 20);
		frmPaperSubmissionSystem.getContentPane().add(passwordField);

		JButton btnNewButton = new JButton("Sign In");
		btnNewButton.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				String user = userField.getText();
				String password = String.valueOf(passwordField.getPassword());


				if (accounts.checkExistingEmail(user)) {

					if(accounts.returnResearcher(user) != null) {

						if (password.equals(accounts.returnResearcher(user).getPassword())) {
							currentResearch = accounts.returnResearcher(user);
							frmPaperSubmissionSystem.dispose();
							researcherMenu();
							passwordField.setText("");
							userField.setText("");
						} else {
							JOptionPane.showMessageDialog(popup,
			                        "The password or username is incorrect.");
							return;
						}

					} else if(accounts.returnReviewer(user) != null) {

						if (password.equals(accounts.returnReviewer(user).getPassword())) {
							currentReview = accounts.returnReviewer(user);
							System.out.println("Correct reviewer");
							
							passwordField.setText("");
							userField.setText("");
						} else {
							JOptionPane.showMessageDialog(popup,
			                        "The password or username is incorrect.");
							return;
						}

					} else {

						if (password.equals(accounts.returnEditor(user).getPassword())) {
							currentEditor = accounts.returnEditor(user);
							System.out.println("Correct editor");
							
							passwordField.setText("");
							userField.setText("");
						} else {
							JOptionPane.showMessageDialog(popup,
			                        "The password or username is incorrect.");
							return;

						}
					}

				} else {
					JOptionPane.showMessageDialog(popup,
	                        "The password or username is incorrect");
					return;
				}


			}
		});
		btnNewButton.setBounds(287, 176, 81, 20);
		frmPaperSubmissionSystem.getContentPane().add(btnNewButton);
		//forgotPass.setCursor(Cursor.getPredefinedCursor(Cursor.HAND_CURSOR));

		JLabel lblNewLabel_1 = new JLabel("|");
		lblNewLabel_1.setBounds(260, 248, 46, 14);
		frmPaperSubmissionSystem.getContentPane().add(lblNewLabel_1);

		JPanel panel = new JPanel();
		panel.setBackground(new Color(255, 255, 255));
		panel.setBounds(134, 24, 247, 29);
		frmPaperSubmissionSystem.getContentPane().add(panel);

		loginTitle = new JLabel("Paper Submission System");
		panel.add(loginTitle);
		loginTitle.setFont(new Font("Segoe UI", Font.BOLD, 18));
	}
	
	private void forgotPassword() {
		forgotPassword = new JFrame();
		
		forgotPassword = new JFrame();
		forgotPassword.setTitle("Paper Submission System");
		forgotPassword.setIconImage(Toolkit.getDefaultToolkit().getImage("C:\\Users\\Shiina\\Desktop\\CPSC\\Seng300\\src\\unnamed.png"));
		forgotPassword.setBounds(100, 100, 435, 300);
		forgotPassword.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		forgotPassword.getContentPane().setLayout(null);
		forgotPassword.setLocationRelativeTo(null);
		
		JFrame popup = new JFrame();
		JButton btnNewButton_1 = new JButton("Reset password");
		popup.setLocationRelativeTo(null);	
		popup.getContentPane().add(btnNewButton_1);
		popup.pack();
		
		
		JTextField textField = new JTextField();
		textField.setBounds(116, 138, 163, 20);
		forgotPassword.getContentPane().add(textField);
		textField.setColumns(10);
		
		JLabel lblNewLabel = new JLabel("Please enter the email address of your account.");
		lblNewLabel.setBounds(86, 32, 308, 14);
		forgotPassword.getContentPane().add(lblNewLabel);
		
		JLabel lblNewLabel_1 = new JLabel("A temporary password will be sent to you via email.");
		lblNewLabel_1.setBounds(86, 57, 308, 14);
		forgotPassword.getContentPane().add(lblNewLabel_1);
		
		JLabel lblNewLabel_2 = new JLabel("Please use it to gain access to your account. ");
		lblNewLabel_2.setBounds(86, 82, 308, 14);
		forgotPassword.getContentPane().add(lblNewLabel_2);
		
		JLabel lblNewLabel_3 = new JLabel("Email Address:");
		lblNewLabel_3.setBounds(22, 141, 94, 14);
		forgotPassword.getContentPane().add(lblNewLabel_3);
		
		JButton btnNewButton = new JButton("Cancel");
		btnNewButton.setBounds(79, 200, 89, 23);
		forgotPassword.getContentPane().add(btnNewButton);
		btnNewButton.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				forgotPassword.dispose();
				frmPaperSubmissionSystem.setVisible(true);
			}
		});
		
		btnNewButton_1.setBounds(235, 200, 131, 23);
		forgotPassword.getContentPane().add(btnNewButton_1);
		btnNewButton_1.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				String email = textField.getText();
				String newPassword = RandomString.getAlphaNumericString(10);
				
				if (accounts.checkExistingEmail(email)) {
					String account1 = accounts.returnAccount(email);
					switch (account1) {
					
					case "Researcher":
						accounts.returnResearcher(email).setPassword(newPassword);
						try {
							JavaMail.sendMail(email, emailSubject2, JavaMail.forgotPasswordString(newPassword));
						} catch (Exception e1) {
							// TODO Auto-generated catch block
							e1.printStackTrace();
						}
						break;
					case "Reviewer":
						accounts.returnReviewer(email).setPassword(newPassword);
						try {
							JavaMail.sendMail(email, emailSubject2, JavaMail.forgotPasswordString(newPassword));
						} catch (Exception e1) {
							// TODO Auto-generated catch block
							e1.printStackTrace();
						}
						break;
						
					default:
						accounts.returnEditor(email).setPassword(newPassword);
						try {
							JavaMail.sendMail(email, emailSubject2, JavaMail.forgotPasswordString(newPassword));
						} catch (Exception e1) {
							// TODO Auto-generated catch block
							e1.printStackTrace();
						}
									
					}
				} else {
					JOptionPane.showMessageDialog(popup,
	                        "The email does not exist");	
				}
				
			}
		});
		
		forgotPassword.setVisible(true);
	}

	private void accountCreation() {

		accountCreation = new JFrame();

		accountCreation.setIconImage(Toolkit.getDefaultToolkit().getImage("C:\\Users\\Shiina\\Desktop\\CPSC\\Seng300\\src\\unnamed.png"));
		accountCreation.setTitle("Paper Submission System");
		accountCreation.getContentPane().setBackground(new Color(128, 128, 128));
		accountCreation.setBounds(100, 100, 450, 439);
		accountCreation.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		accountCreation.getContentPane().setLayout(null);
		accountCreation.setLocationRelativeTo(null);

		JButton btnNewButton = new JButton("Create account");
		JButton btnNewButton2 = new JButton("Cancel");
		JFrame popup = new JFrame();
		popup.setLocationRelativeTo(null);
		popup.getContentPane().add(btnNewButton);
		popup.pack();
		
		
		btnNewButton2.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				frmPaperSubmissionSystem.setVisible(true);
				accountCreation.dispose();
				
			}
		});
		btnNewButton2.setBounds(52, 336, 89, 28);
		accountCreation.getContentPane().add(btnNewButton2);

		JLabel lblNewLabel = new JLabel("Name");
		lblNewLabel.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblNewLabel.setBounds(54, 81, 80, 14);
		accountCreation.getContentPane().add(lblNewLabel);

		JTextField textField = new JTextField();
		textField.setBounds(54, 106, 196, 20);
		accountCreation.getContentPane().add(textField);
		textField.setColumns(10);

		JLabel lblNewLabel_1 = new JLabel("Email");
		lblNewLabel_1.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblNewLabel_1.setBounds(52, 137, 46, 14);
		accountCreation.getContentPane().add(lblNewLabel_1);

		JTextField textField_1 = new JTextField();
		textField_1.setBounds(52, 162, 196, 20);
		accountCreation.getContentPane().add(textField_1);
		textField_1.setColumns(10);

		JLabel lblNewLabel_2 = new JLabel("Password");
		lblNewLabel_2.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblNewLabel_2.setBounds(52, 193, 70, 14);
		accountCreation.getContentPane().add(lblNewLabel_2);

		JLabel lblNewLabel_3 = new JLabel("Role");
		lblNewLabel_3.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblNewLabel_3.setBounds(295, 81, 56, 14);
		accountCreation.getContentPane().add(lblNewLabel_3);

		JComboBox comboBox = new JComboBox();
		comboBox.setModel(new DefaultComboBoxModel(new String[] {"Researcher", "Reviewer", "Editor"}));
		comboBox.setMaximumRowCount(3);
		comboBox.setBounds(295, 106, 99, 20);
		accountCreation.getContentPane().add(comboBox);

		JLabel lblNewLabel_4 = new JLabel("Confirm Password");
		lblNewLabel_4.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblNewLabel_4.setBounds(52, 249, 122, 14);
		accountCreation.getContentPane().add(lblNewLabel_4);

		JPasswordField passwordField1 = new JPasswordField();
		passwordField1.setBounds(52, 218, 196, 20);
		accountCreation.getContentPane().add(passwordField1);

		JPasswordField passwordField2 = new JPasswordField();
		passwordField2.setBounds(52, 274, 196, 20);
		accountCreation.getContentPane().add(passwordField2);

		JLabel lblNewLabel_5 = new JLabel("Create your account");
		lblNewLabel_5.setFont(new Font("Tahoma", Font.PLAIN, 18));
		lblNewLabel_5.setBounds(54, 25, 212, 20);
		accountCreation.getContentPane().add(lblNewLabel_5);

		JComboBox comboBox_1 = new JComboBox();
		comboBox_1.setModel(new DefaultComboBoxModel(new String[] {"Medicine", "Arts", "Kinesiology", "Law", "Nursing", "Science", "Engineering", "Business", "Education"}));
		comboBox_1.setBounds(295, 162, 99, 20);
		accountCreation.getContentPane().add(comboBox_1);

		JLabel lblNewLabel_6 = new JLabel("Faculty");
		lblNewLabel_6.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblNewLabel_6.setBounds(295, 138, 46, 14);
		accountCreation.getContentPane().add(lblNewLabel_6);


		btnNewButton.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				String password1 = String.valueOf(passwordField1.getPassword());
				String password2 = String.valueOf(passwordField2.getPassword());
				String name = textField.getText();
				String email = textField_1.getText();
				String faculty = String.valueOf(comboBox_1.getSelectedItem());
				String role = String.valueOf(comboBox.getSelectedItem());

				if (name.isEmpty()) {
					JOptionPane.showMessageDialog(popup,
	                        "The name field cannot be empty.");
					return;
				} else if (email.isEmpty()) {
					JOptionPane.showMessageDialog(popup,
	                        "The email field cannot be empty.");
					return;
				} else if (password1.isEmpty()) {
					JOptionPane.showMessageDialog(popup,
	                        "The password field cannot be empty.");
					return;
				} else if (password2.isEmpty()) {
					JOptionPane.showMessageDialog(popup,
	                        "Please confirm your password.");
					return;
				}

				if (password1.equals(password2)) {
					if (accounts.checkExistingEmail(textField_1.getText()) == false) {

						switch (role) {

						case "Researcher":
							Researcher account = new Researcher();
							account.setName(name);
							account.setEmail(email);
							account.setFaculty(faculty);
							account.setPassword(password1);
							accounts.addResearcher(email, account);
							break;

						case "Reviewer":
							Reviewer account1 = new Reviewer();
							account1.setName(name);
							account1.setEmail(email);
							account1.setPassword(password1);
							accounts.addReviewer(email, account1);
							break;

						default:
							Editor account2 = new Editor();
							account2.setName(name);
							account2.setEmail(email);
							account2.setPassword(password1);
							accounts.addEditor(email, account2);

						}

						JOptionPane.showMessageDialog(popup,
		                        "Your account has been created. Please sign in.");
						try {
							if (role.equals("Reviewer") || role.equals("Editor")) {
								JavaMail.sendMail(email, emailSubject1, JavaMail.accountCreationString(name, "N/A", email));
							}
							JavaMail.sendMail(email, emailSubject1, JavaMail.accountCreationString(name, faculty, email));
						} catch (Exception e1) {
							// TODO Auto-generated catch block
							e1.printStackTrace();
						}
						
						frmPaperSubmissionSystem.setVisible(true);
						accountCreation.dispose();

					} else {
						JOptionPane.showMessageDialog(popup,
		                        "Email already exists.");
					}

				} else {
					JOptionPane.showMessageDialog(popup,
	                        "The passwords do not match.");
				}

			}
		});
		btnNewButton.setBounds(162, 338, 135, 23);
		accountCreation.getContentPane().add(btnNewButton);


		accountCreation.setVisible(true);


	}


	private void researcherMenu() {

		researcherMenu = new JFrame();

		researcherMenu.setIconImage(Toolkit.getDefaultToolkit().getImage("C:\\Users\\Shiina\\Desktop\\CPSC\\Seng300\\src\\unnamed.png"));
		researcherMenu.setTitle("Paper Submission System");
		researcherMenu.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		researcherMenu.setBounds(100, 100, 514, 333);
		researcherMenu.setLayout(null);
		researcherMenu.getContentPane().setLayout(null);
		researcherMenu.setLocationRelativeTo(null);

		JTable table = new JTable();
		table.setSelectionMode(ListSelectionModel.SINGLE_SELECTION);
		table.setBorder(new EtchedBorder(EtchedBorder.LOWERED, Color.BLACK, null));
		table.setEnabled(false);
		table.setRowSelectionAllowed(false);
		table.setModel(new DefaultTableModel(
			new Object[][] {
				{null, "", null},
				{null, null, null},
				{null, null, null},
				{null, null, null},
				{null, null, null},
				{null, null, null},
			},
			new String[] {
				"Submission ", "Status", "Revision"
			}
		) {
			Class[] columnTypes = new Class[] {
				Integer.class, String.class, String.class
			};
			public Class getColumnClass(int columnIndex) {
				return columnTypes[columnIndex];
			}
		});
		table.setBounds(23, 134, 268, 92);
		researcherMenu.add(table);

		JButton btnNewButton = new JButton("Settings");
		btnNewButton.setBounds(357, 45, 89, 23);
		researcherMenu.add(btnNewButton);
		btnNewButton.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				researcherMenu.dispose();
				settings();
			}
		});

		JButton btnNewButton_1 = new JButton("Submit ");
		btnNewButton_1.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
			}
		});
		btnNewButton_1.setBounds(357, 123, 89, 23);
		researcherMenu.add(btnNewButton_1);

		JTextPane txtpnSdsdsds = new JTextPane();
		txtpnSdsdsds.setEditable(false);
		txtpnSdsdsds.setText(currentResearch.getName());
		txtpnSdsdsds.setBounds(79, 64, 212, 20);
		researcherMenu.add(txtpnSdsdsds);

		JLabel lblNewLabel = new JLabel("Currently logged in as:");
		lblNewLabel.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblNewLabel.setToolTipText("");
		lblNewLabel.setBounds(23, 34, 160, 23);
		researcherMenu.add(lblNewLabel);

		JLabel lblNewLabel_1 = new JLabel("Name:");
		lblNewLabel_1.setBounds(23, 64, 46, 14);
		researcherMenu.add(lblNewLabel_1);

		JButton btnNewButton_2 = new JButton("Status");
		btnNewButton_2.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
			}
		});
		btnNewButton_2.setBounds(357, 199, 89, 23);
		researcherMenu.add(btnNewButton_2);

		JLabel lblNewLabel_2 = new JLabel("Faculty:");
		lblNewLabel_2.setBounds(23, 89, 46, 14);
		researcherMenu.add(lblNewLabel_2);

		JTextPane textPane = new JTextPane();
		textPane.setEditable(false);
		textPane.setText(currentResearch.getFaculty());
		textPane.setBounds(79, 89, 212, 20);
		researcherMenu.add(textPane);

		JButton btnNewButton_3 = new JButton("Logout ");
		btnNewButton_3.setBounds(23, 260, 89, 23);
		researcherMenu.add(btnNewButton_3);

		JLabel lblNewLabel_3 = new JLabel("Submissions");
		lblNewLabel_3.setBounds(33, 123, 88, 10);
		researcherMenu.add(lblNewLabel_3);
		
		btnNewButton_3.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				currentResearch = null;
				researcherMenu.dispose();
				frmPaperSubmissionSystem.setVisible(true);
			}
		});

		JLabel lblStatus = new JLabel("Status");
		lblStatus.setBounds(141, 123, 69, 10);
		researcherMenu.add(lblStatus);

		JLabel lblRevision = new JLabel("Revision");
		lblRevision.setBounds(222, 123, 69, 10);
		researcherMenu.add(lblRevision);

		researcherMenu.setVisible(true);

	}
	
	private void settings() {
		
		settings = new JFrame();

		settings.setIconImage(Toolkit.getDefaultToolkit().getImage("C:\\Users\\Shiina\\Desktop\\CPSC\\Seng300\\src\\unnamed.png"));
		settings.setTitle("Paper Submission System");
		settings.setBounds(100, 100, 450, 411);
		settings.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		settings.getContentPane().setLayout(null);
		settings.setLocationRelativeTo(null);
		
		JButton btnNewButton_1 = new JButton("Confirm Changes");
		JFrame popup = new JFrame();
		popup.setLocationRelativeTo(null);
		popup.getContentPane().add(btnNewButton_1);
		popup.pack();
		
		JLabel lblNewLabel = new JLabel("Change Name:");
		lblNewLabel.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblNewLabel.setBounds(26, 74, 115, 21);
		settings.getContentPane().add(lblNewLabel);
		
		JTextField textField = new JTextField();
		textField.setBounds(143, 75, 115, 20);
		settings.getContentPane().add(textField);
		textField.setColumns(10);
		
		JLabel lblNewLabel_1 = new JLabel("Account Settings");
		lblNewLabel_1.setFont(new Font("Tahoma", Font.PLAIN, 15));
		lblNewLabel_1.setBounds(26, 21, 214, 31);
		settings.getContentPane().add(lblNewLabel_1);
		
		JLabel lblNewLabel_2 = new JLabel("Change Faculty:");
		lblNewLabel_2.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblNewLabel_2.setBounds(25, 132, 116, 21);
		settings.getContentPane().add(lblNewLabel_2);
		
		JComboBox comboBox = new JComboBox();
		comboBox.setBounds(143, 133, 115, 20);
		settings.getContentPane().add(comboBox);
		comboBox.setModel(new DefaultComboBoxModel(new String[] {"Medicine", "Arts", "Kinesiology", "Law", "Nursing", "Science", "Engineering", "Business", "Education"}));
		
		JLabel lblNewLabel_3 = new JLabel("Change Password:");
		lblNewLabel_3.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblNewLabel_3.setBounds(26, 199, 107, 21);
		settings.getContentPane().add(lblNewLabel_3);
		
		JLabel lblNewLabel_4 = new JLabel("Confirm Password:");
		lblNewLabel_4.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblNewLabel_4.setBounds(26, 241, 115, 21);
		settings.getContentPane().add(lblNewLabel_4);
		
		JPasswordField passwordField1 = new JPasswordField();
		passwordField1.setBounds(143, 200, 115, 20);
		settings.getContentPane().add(passwordField1);
		
		JPasswordField passwordField2 = new JPasswordField();
		passwordField2.setBounds(143, 242, 115, 20);
		settings.getContentPane().add(passwordField2);
		
		JTextPane textPane = new JTextPane();
		textPane.setBounds(288, 75, 124, 127);
		settings.getContentPane().add(textPane);
		
		
		JButton btnNewButton = new JButton("Back");
		btnNewButton.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				String currentAccount = Accounts.checkAccount(currentResearch, currentReview, currentEditor);
				switch (currentAccount) {
				case "Researcher":
					researcherMenu();
					break;
				case "Reviewer":
					//reviewerMenu()
					break;
				default: 
					//editorMenu()
				}
				settings.dispose();
				
			}
		});
		btnNewButton.setBounds(26, 313, 89, 23);
		settings.getContentPane().add(btnNewButton);
		
		btnNewButton_1.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				
				String newName = textField.getText();
				String password1 = String.valueOf(passwordField1.getPassword());
				String password2 = String.valueOf(passwordField2.getPassword());
				String newFaculty = String.valueOf(comboBox.getSelectedItem());
				String description = textPane.getText();
				
				String currentAccount = Accounts.checkAccount(currentResearch, currentReview, currentEditor);
				switch (currentAccount) {
				case "Researcher":
					
					if (password1.equals(password2)) {
						if (newName.length() != 0) {
							accounts.returnResearcher(currentResearch.getEmail()).setName(newName);
						}
						
						if(password1.length() != 0) {
							accounts.returnResearcher(currentResearch.getEmail()).setPassword(password1);
						}
						
						accounts.returnResearcher(currentResearch.getEmail()).setFaculty(newFaculty);
						accounts.returnResearcher(currentResearch.getEmail()).setDescription(description);
		
						JOptionPane.showMessageDialog(popup,
		                        "Your changes have been confirmed.");		
					} else {
						JOptionPane.showMessageDialog(popup,
		                        "The passwords do not match.");
					}
					
					break;
					
				case "Reviewer":
					
					if (password1.equals(password2)) {
						if (newName.length() != 0) {
							accounts.returnReviewer(currentReview.getEmail()).setName(newName);
						}
						
						if(password1.length() != 0) {
							accounts.returnReviewer(currentReview.getEmail()).setPassword(password1);
						}
						accounts.returnReviewer(currentReview.getEmail()).setDescription(description);
						JOptionPane.showMessageDialog(popup,
		                        "Your changes have been confirmed.");		
					} else {
						JOptionPane.showMessageDialog(popup,
		                        "The passwords do not match.");
					}
					break;
					
				default: 
					
					if (password1.equals(password2)) {
						if (newName.length() != 0) {
							accounts.returnEditor(currentEditor.getEmail()).setName(newName);
						}
						
						if(password1.length() != 0) {
							accounts.returnEditor(currentEditor.getEmail()).setPassword(password1);
						}
						accounts.returnEditor(currentEditor.getEmail()).setDescription(description);
						JOptionPane.showMessageDialog(popup,
		                        "Your changes have been confirmed.");		
					} else {
						JOptionPane.showMessageDialog(popup,
		                        "The passwords do not match.");
					}
				}
					
				
			}
		});
		btnNewButton_1.setBounds(272, 313, 134, 23);
		settings.getContentPane().add(btnNewButton_1);
		settings.setVisible(true);
		
	}





	private static void addPopup(Component component, final JPopupMenu popup) {
		component.addMouseListener(new MouseAdapter() {
			public void mousePressed(MouseEvent e) {
				if (e.isPopupTrigger()) {
					showMenu(e);
				}
			}
			public void mouseReleased(MouseEvent e) {
				if (e.isPopupTrigger()) {
					showMenu(e);
				}
			}
			private void showMenu(MouseEvent e) {
				popup.show(e.getComponent(), e.getX(), e.getY());
			}
		});
	}
}
