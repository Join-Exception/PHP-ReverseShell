# PHP Remote Shell Script

This PHP script establishes a remote shell session with a server running on `127.0.0.1` (localhost) at port `1337`. It provides basic functionality to execute commands on the remote server and retrieve system information.

## Features

1. **System Information Display**:
   - Hostname
   - Local IP address
   - Public IP address (retrieved from `http://ifconfig.me/ip`)
   - Operating System details
   - PHP version
   - System architecture

2. **Remote Command Execution**:
   - Allows execution of shell commands via the remote shell interface.
   - Outputs command results back to the remote client.

3. **ASCII Art Banner**:
   - Displays a custom banner when a connection is successfully established.

## Usage

### Prerequisites
- A PHP environment must be set up on the host machine.
- Ensure that port `1337` is open and not blocked by a firewall.
- The script requires an internet connection to fetch the public IP address.

### Running the Script
1. Place the script on your PHP-enabled server.
2. Start a listener on the remote machine using a tool like `netcat`. For example:
   ```bash
   nc -lvnp 1337
   ```
3. Execute the PHP script.
4. Upon connection, the script will send system information and provide a shell prompt.

### Commands
- Enter any shell command in the remote shell to execute it on the host machine.
- Use the `exit` command to terminate the session.

## Code Breakdown

### Functions
- `ipv4()`: Fetches the public IP address using `http://ifconfig.me/ip`.

### Key Variables
- `$ascii`: Contains ASCII art displayed upon connection.
- `$sock`: The socket connection to the remote client.

### Workflow
1. Establishes a socket connection to `127.0.0.1` on port `1337`.
2. Retrieves system details such as hostname, IP addresses, OS details, and PHP version.
3. Sends the information and a shell prompt to the client.
4. Continuously listens for commands from the client and executes them until `exit` is received.

## Security Considerations
- **Localhost Restriction**: The script is currently set to connect only to `127.0.0.1`. Modify this for other use cases, but be cautious.
- **Shell Access**: Executing arbitrary shell commands poses a security risk. Use this script in controlled environments only.
- **Public IP API**: The script uses `http://ifconfig.me/ip` to fetch the public IP address. Ensure this service is reliable and trusted.

## Disclaimer
This script is intended for educational purposes or controlled environments. Misuse of this script can lead to security vulnerabilities. Use responsibly and ensure proper authorization before executing on any system.

