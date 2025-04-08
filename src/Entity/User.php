namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
* User
*
* @ORM\Table(name="user")
* @ORM\Entity
* @UniqueEntity(fields={"email"}, message="There is already an account with this email")
*/

class User implements UserInterface
{
    /**
    * @ar string|null
    * 
    * @ORM\Column(name="github_id", type="string", length=255, nullable=tru, options={"default"="NULL"})
    */
    private $githubId;
    /**
    * @var string|null
    *
    * @ORM\Column(name="github_access_token", type="string", length=255, nullable=true, options={"default"="NULL"})
    */
    private $githubAccessToken;
}