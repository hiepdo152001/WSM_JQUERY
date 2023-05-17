laravel debug bar
laravel ide help

laravel error handle api

swagger >> yaml
<script>
export const getUserDetails = (id) => async (dispatch, getState) => {
    try{
        dispatch({
            type: USER_DETAILS_REQUEST,
        })
        const {
            userLogin: {userInfo}
        } = getState()
        const config = {
            headers: {
                'Content-type': 'application/json',
                Authorization: `Bearer ${userInfo.token}`
            }
        }
        const {data} = await axios.get(
            `auth/user/${id}`,
            config
        )
        dispatch({
            type:USER_DETAILS_SUCCESS,
            payload: data
        })
    }
    catch(error){
        dispatch({
            type:USER_DETAILS_FAIL,
            payload: error.response && error.response.data.message
            ?error.response.data.message
            :error.message,
        })
    }
}
</script>